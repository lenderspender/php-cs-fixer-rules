# lenderspender/php-cs-fixer-rules

Shared PHP style rules for Lender & Spender.

## Pint

Extend this package's `pint.json` from your own:

```json
{
    "extend": "vendor/lenderspender/php-cs-fixer-rules/pint.json",
    "rules": {
        "Pint/laravel_blade": true
    },
    "exclude": []
}
```

This package deliberately ships **no** `exclude` key — consuming repos own their excludes.
`array_replace_recursive` merges lists by index, so an `exclude` here would splice into yours
rather than extend it.

## Why every rule is listed explicitly

`pint.json` uses `"preset": "empty"` with all 160 rules spelled out, instead of the much shorter
`"preset": "symfony"` plus overrides. **This is not accidental — do not collapse it back to a preset
or a `"@Symfony": true` key.**

Pint swaps in Blade-safe variants of certain fixers (`Fixers/LaravelBlade/NoUnusedImportsFixer`,
`TypeAnnotationsOnlyFixer`) by matching **fixer names** in the `rules` array. `@Symfony` is a *set*
key, not a fixer name, so the substitution never fires and the raw fixers run against Blade
fragments instead.

The practical failure: a Blade template that declares an import inside an `@php` block and uses it
in a directive outside that block. The raw `NoUnusedImportsFixer` only sees the PHP fragment, decides
the import is unused, and deletes it — the template then breaks at render time.

Measured on the platform repo:

| | `"preset": "symfony"` | expanded ruleset |
|---|---|---|
| Blade files that lose imports (of 37 at risk) | 32 | 0 |
| Blade files touched at all | 521 | 225 |

## Regenerating `pint.json`

`src/rules.php` is the source of truth — it is what repos still on php-cs-fixer consume, and it is
what the generator reads. **Do not hand-edit `pint.json`.** Change `src/rules.php`, then regenerate:

```bash
composer install
php -r '
require "vendor/autoload.php";
$ls = require "src/rules.php"; unset($ls["@Symfony"]);
$symfony = (new PhpCsFixer\RuleSet\RuleSet(["@Symfony" => true]))->getRules();
$symfony["no_unused_imports"] = true;
file_put_contents("pint.json", json_encode(
    ["preset" => "empty", "rules" => array_merge($symfony, $ls)],
    JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
) . "\n");
'
```

The command is idempotent. It expands `@Symfony`, adds `no_unused_imports`, and applies the
Lender & Spender overrides last so they win.

Note that the expanded output tracks whatever php-cs-fixer version is installed (generated against
v3.95.18, yielding 160 rules). If a regeneration changes the rule count, that is upstream set drift,
not a mistake — review the diff before committing.
