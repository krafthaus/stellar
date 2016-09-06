<?php

namespace KraftHaus\Stellar\Tests\Resources;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use KraftHaus\Stellar\Support\Facades\Asset;
use KraftHaus\Stellar\Tests\AbstractTestCase;

class AssetTest extends AbstractTestCase
{

    /**
     * Test that we can create a new asset group and
     * the initial values are all empty.
     *
     * @test
     */
    public function can_make_new_group()
    {
        $group = 'test-group';

        $instance = Asset::make($group);

        $this->assertNotNull(Asset::get($group));
        $this->assertNotNull($instance);

        $this->assertEmpty(Asset::get($group)->css());
        $this->assertEmpty($instance->css());

        $this->assertEmpty(Asset::get($group)->js());
        $this->assertEmpty($instance->js());
    }

    /**
     * Test that a non existing group equals null.
     *
     * @test
     */
    function non_existing_group_is_null()
    {
        $this->assertNull(Asset::get('test-group'));
    }

    /**
     * Test that we can add css to a group and make sure other values are still empty.
     *
     * @test
     */
    function can_add_css_to_a_group()
    {
        $group = 'test-group';

        $instance = Asset::make($group)->add('test.css');

        $this->assertNotEmpty($instance->css());
        $this->assertEmpty($instance->js());

        $this->assertInternalType('string', $instance->css());
        $this->assertInternalType('string', $instance->js());
    }

    /**
     * Test that we can add js to a group and make sure other values are still empty.
     *
     * @test
     */
    function can_add_js_to_a_group()
    {
        $group = 'test-group';

        $instance = Asset::make($group)->add('test.js');

        $this->assertNotEmpty($instance->js());
        $this->assertEmpty($instance->css());

        $this->assertInternalType('string', $instance->css());
        $this->assertInternalType('string', $instance->js());
    }
}