<?php

/**
 * This file contains the ForbiddenExceptionInputDataTest class.
 *
 * SPDX-FileCopyrightText: Copyright 2022 Move Agency Group B.V., Zwolle, The Netherlands
 * SPDX-License-Identifier: MIT
 */

namespace Lunr\Corona\Exceptions\Tests;

/**
 * This class contains tests for the ForbiddenException class.
 *
 * @covers Lunr\Corona\Exceptions\ForbiddenException
 */
class ForbiddenExceptionInputDataTest extends ForbiddenExceptionTest
{

    /**
     * Test that setData() sets the data correctly.
     *
     * @covers Lunr\Corona\Exceptions\ForbiddenException::setData
     */
    public function testSetDataSetsData(): void
    {
        $this->class->setData('foo', 'bar');

        $this->assertPropertyEquals('key', 'foo');
        $this->assertPropertyEquals('value', 'bar');
    }

    /**
     * Test that getDataKey() returns the data key.
     *
     * @covers Lunr\Corona\Exceptions\ForbiddenException::getDataKey
     */
    public function testGetDataKey(): void
    {
        $this->set_reflection_property_value('key', 'foo');

        $this->assertEquals('foo', $this->class->getDataKey());
    }

    /**
     * Test that getDataValue() returns the data value.
     *
     * @covers Lunr\Corona\Exceptions\ForbiddenException::getDataValue
     */
    public function testGetDataValue(): void
    {
        $this->set_reflection_property_value('value', 'bar');

        $this->assertEquals('bar', $this->class->getDataValue());
    }

    /**
     * Test that isDataAvailable() returns whether input data was set.
     *
     * @covers Lunr\Corona\Exceptions\ForbiddenException::isDataAvailable
     */
    public function testIsDataAvailable(): void
    {
        $this->assertFalse($this->class->isDataAvailable());

        $this->set_reflection_property_value('key', 'foo');

        $this->assertTrue($this->class->isDataAvailable());
    }

}

?>
