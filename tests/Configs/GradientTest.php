<?php namespace Khill\Lavacharts\Tests\Configs;

use Khill\Lavacharts\Lavacharts;
use Khill\Lavacharts\Tests\TestCase;
use Khill\Lavacharts\Configs\gradient;

class GradientTest extends TestCase {

    public function setUp()
    {
        parent::setUp();

        $this->g = new gradient();
    }

    public function testIfInstanceOfGradient()
    {
        $this->assertInstanceOf('Khill\Lavacharts\Configs\gradient', $this->g);
    }
/*
    public function testExpose()
    {
        $gradient = new gradient();

        $this->assertEquals(array(
                'color1',
                'color2',
                'x1',
                'y1',
                'x2',
                'y2'
            ),
            $gradient->expose()
        );
    }
*/
    public function testConstructorDefaults()
    {
        $this->assertRegExp('/#([a-fA-F0-9]){3}(([a-fA-F0-9]){3})?\b/', $this->g->color1);
        $this->assertRegExp('/#([a-fA-F0-9]){3}(([a-fA-F0-9]){3})?\b/', $this->g->color2);
        $this->assertEquals('0%',   $this->g->x1);
        $this->assertEquals('0%',   $this->g->y1);
        $this->assertEquals('100%', $this->g->x2);
        $this->assertEquals('100%', $this->g->y2);
    }

    public function testConstructorValuesAssignment()
    {
        $gradient = new gradient(array(
            'color1' => '#F0F0F0',
            'color2' => '#3D3D3D',
            'x1'     => '0%',
            'y1'     => '0%',
            'x2'     => '100%',
            'y2'     => '100%'
        ));

        $this->assertEquals('#F0F0F0', $gradient->color1);
        $this->assertEquals('#3D3D3D', $gradient->color2);
        $this->assertEquals('0%',      $gradient->x1);
        $this->assertEquals('0%',      $gradient->y1);
        $this->assertEquals('100%',    $gradient->x2);
        $this->assertEquals('100%',    $gradient->y2);
    }

    public function testConstructorWithInvalidPropertiesKey()
    {
        $gradient = new gradient(array('tacos' => '#F8C3B0'));

        $this->assertTrue(Lavacharts::hasErrors());
    }

    /**
     * @dataProvider badParamsProvider
     */
    public function testColor1WithBadParams($badVals)
    {
        $this->g->color1($badVals);

        $this->assertTrue(Lavacharts::hasErrors());
    }

    /**
     * @dataProvider badParamsProvider
     */
    public function testColor2WithBadParams($badVals)
    {
        $this->g->color2($badVals);

        $this->assertTrue(Lavacharts::hasErrors());
    }

    /**
     * @dataProvider badParamsProvider
     */
    public function testX1ColorWithBadParams($badVals)
    {
        $this->g->x1($badVals);

        $this->assertTrue(Lavacharts::hasErrors());
    }

    /**
     * @dataProvider badParamsProvider
     */
    public function testY1ColorWithBadParams($badVals)
    {
        $this->g->y1($badVals);

        $this->assertTrue(Lavacharts::hasErrors());
    }

    /**
     * @dataProvider badParamsProvider
     */
    public function testX2ColorWithBadParams($badVals)
    {
        $this->g->x2($badVals);

        $this->assertTrue(Lavacharts::hasErrors());
    }

    /**
     * @dataProvider badParamsProvider
     */
    public function testY2ColorWithBadParams($badVals)
    {
        $this->g->y2($badVals);

        $this->assertTrue(Lavacharts::hasErrors());
    }

    public function badParamsProvider()
    {
        return array(
            array(123),
            array(123.456),
            array(array()),
            array(new \stdClass()),
            array(true),
            array(null)
        );
    }

}
