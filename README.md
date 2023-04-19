# Suite Tag Isolation Extension

Adds the `--isolate` option to Behat CLI, which allows to run suites configured with specific tags.

## Usage

1. Install it:

    ```bash
    $ composer require no-response-mate/suite-tag-isolation-extension --dev
    ```

2. Enable it in your Behat configuration:

    ```yml
    # behat.yml
    default:
        # ...
        extensions:
            NoResponseMate\SuiteTagIsolationExtension: ~
    ```

3. Set the option while running Behat:

    ```bash
    $ vendor/bin/behat --isolate="domain"
    $ vendor/bin/behat --isolate="~domain"
    $ vendor/bin/behat --isolate="domain,ui"
    $ vendor/bin/behat --isolate="domain&&ui"
    ```
