<?php
/**
 * Vehicle Fits
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to sales@vehiclefits.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Vehicle Fits to newer
 * versions in the future. If you wish to customize Vehicle Fits for your
 * needs please refer to http://www.vehiclefits.com for more information.
 * @copyright  Copyright (c) 2013 Vehicle Fits, llc
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class VF_SchemaTests_MMY_SchemaTest extends VF_TestCase
{
    function doSetUp()
    {
        $this->switchSchema('make,model,year');
    }

    function testLevels()
    {
        $schema = new VF_Schema();
        $this->assertEquals(array('make', 'model', 'year'), $schema->getLevels(), 'should get levels');
    }

    function testGetRootLevel()
    {
        $schema = new VF_Schema();
        $this->assertEquals(self::ENTITY_TYPE_MAKE, $schema->getRootLevel(), 'root level should be "make"');
    }

    function testGetLeafLevel()
    {
        $schema = new VF_Schema();
        $this->assertEquals(self::ENTITY_TYPE_YEAR, $schema->getLeafLevel(), 'root level should be "year"');
    }

    function testPrevLevelMake()
    {
        $schema = new VF_Schema();
        $this->assertEquals(false, $schema->getPrevLevel('make'));
    }

    function testPrevLevelModel()
    {
        $schema = new VF_Schema();
        $this->assertEquals('make', $schema->getPrevLevel('model'));
    }

    function testNextLevelMake()
    {
        $schema = new VF_Schema();
        $this->assertEquals('model', $schema->getNextLevel('make'));
    }

    function testNextLevelModel()
    {
        $schema = new VF_Schema();
        $this->assertEquals('year', $schema->getNextLevel('model'));
    }

    function testNextLevelYear()
    {
        $schema = new VF_Schema();
        $this->assertFalse($schema->getNextLevel('year'));
    }

    function testLevelIsBefore()
    {
        $schema = new VF_Schema();
        $this->assertTrue($schema->levelIsBefore('make', 'model'));
    }

    function testLevelIsBefore2()
    {
        $schema = new VF_Schema();
        $this->assertFalse($schema->levelIsBefore('model', 'make'));
    }

    function testGetLevelsExceptLeaf()
    {
        $schema = new VF_Schema();
        $this->assertSame(array('make', 'model'), $schema->getLevelsExceptLeaf());
    }

    function testGetLevelsExcluding()
    {
        $schema = new VF_Schema();
        $this->assertSame(array('make', 'year'), $schema->getLevelsExcluding('model'));
    }

    function testGetLevelsExceptRoot()
    {
        $schema = new VF_Schema();
        $this->assertSame(array('model', 'year'), $schema->getLevelsExceptRoot());
    }
}
