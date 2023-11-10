# Suite Tags Extension

Adds the `--suite-tags` option to Behat CLI, which allows to run suites configured with specific tags.

## Usage

1. Install it:

    ```bash
    $ composer require sylius-labs/suite-tags-extension --dev
    ```

2. Enable it in your Behat configuration:

    ```yml
    # behat.yml
    default:
        # ...
        extensions:
            SyliusLabs\SuiteTagsExtension: ~
    ```

3. Set the option while running Behat:

    ```bash
    $ vendor/bin/behat --suite-tags="domain"
    $ vendor/bin/behat --suite-tags="~domain"
    $ vendor/bin/behat --suite-tags="domain,ui"
    $ vendor/bin/behat --suite-tags="domain&&ui"
    ```
