# Tests

This directory contains the test suite for the Laravel Livewire Editor package.

## Test Structure

```
tests/
├── TestCase.php                          # Base test case
├── Unit/                                 # Unit tests
│   ├── CkEditorTest.php                 # CKEditor 4 component tests
│   ├── CkEditor5Test.php                # CKEditor 5 component tests
│   ├── TipTapEditorTest.php             # TipTap editor component tests
│   ├── EditorComponentTraitTest.php     # Editor trait tests
│   ├── LivewireEditorManagerTest.php    # Manager class tests
│   ├── EditorServiceProviderTest.php    # Service provider tests
│   └── LivewireEditorFacadeTest.php     # Facade tests
└── Feature/                              # Feature tests
    ├── LivewireEditorComponentTest.php  # Component integration tests
    ├── BladeDirectivesTest.php          # Blade directive tests
    ├── LivewireComponentRegistrationTest.php # Component registration tests
    └── ConfigurationTest.php            # Configuration tests
```

## Running Tests

### Run All Tests

```bash
composer test
```

Or using PHPUnit directly:

```bash
vendor/bin/phpunit
```

### Run Specific Test Suite

Run only unit tests:

```bash
vendor/bin/phpunit --testsuite=Unit
```

Run only feature tests:

```bash
vendor/bin/phpunit --testsuite=Feature
```

### Run Specific Test File

```bash
vendor/bin/phpunit tests/Unit/CkEditor5Test.php
```

### Run Specific Test Method

```bash
vendor/bin/phpunit --filter it_can_be_instantiated
```

### Run Tests with Coverage

```bash
vendor/bin/phpunit --coverage-html coverage
```

Then open `coverage/index.html` in your browser.

## Writing Tests

### Unit Tests

Unit tests focus on testing individual components in isolation:

```php
<?php

namespace Jaikumar0101\LivewireEditor\Tests\Unit;

use Jaikumar0101\LivewireEditor\Tests\TestCase;
use Livewire\Livewire;

class MyComponentTest extends TestCase
{
    /** @test */
    public function it_does_something()
    {
        $component = Livewire::test(MyComponent::class);
        
        $component->assertSet('property', 'value');
    }
}
```

### Feature Tests

Feature tests focus on testing the integration of multiple components:

```php
<?php

namespace Jaikumar0101\LivewireEditor\Tests\Feature;

use Jaikumar0101\LivewireEditor\Tests\TestCase;

class MyFeatureTest extends TestCase
{
    /** @test */
    public function it_integrates_correctly()
    {
        // Test integration scenarios
    }
}
```

## Test Coverage

The test suite covers:

- ✅ All three editor components (CKEditor 4, CKEditor 5, TipTap)
- ✅ Editor component trait functionality
- ✅ Service provider registration
- ✅ Blade directive registration
- ✅ Facade functionality
- ✅ Configuration management
- ✅ Asset management
- ✅ Component state and lifecycle
- ✅ Multiple editor instances

## Continuous Integration

Tests are designed to run in CI environments. Ensure your CI configuration includes:

```yaml
- composer install --no-interaction --prefer-dist
- composer test
```

## Dependencies

The test suite uses:

- **PHPUnit**: Testing framework
- **Orchestra Testbench**: Laravel package testing
- **Mockery**: Mocking library
- **Livewire**: For component testing

## Troubleshooting

### Tests Failing

1. Ensure all dependencies are installed:
   ```bash
   composer install
   ```

2. Clear any caches:
   ```bash
   vendor/bin/phpunit --cache-clear
   ```

3. Check PHP version (requires 8.1+):
   ```bash
   php -v
   ```

### Memory Issues

If tests fail due to memory limits, increase PHP memory:

```bash
php -d memory_limit=512M vendor/bin/phpunit
```

## Contributing

When adding new features:

1. Write tests first (TDD approach)
2. Ensure all tests pass
3. Aim for high test coverage
4. Follow existing test patterns
