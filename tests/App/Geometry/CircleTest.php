<?php

namespace AppTest\Geometry;

use App\Geometry\Circle;
use App\Geometry\Point;
use App\Geometry\CircleWithCircleIntersector;
use PHPUnit\Framework\TestCase;

class CircleTest extends TestCase
{

    public function testGetName()
    {
        $p1 = new Point(1,1);
        $c1 = new Circle(3, $p1);
        $this->assertEquals('Circle', $c1->getName());
    }    

    public function testGetDiameter()
    {
        $p2 = new Point(2,2);
        $c2 = new Circle(3, $p2);
        $this->assertEquals(6, $c2->getDiameter());
    }

    public function testGetArea()
    {
        $p3 = new Point(0,0);
        $c3 = new Circle(4, $p3);
        $this->assertEquals(50.24, $c3->getArea());
    }

    public function testGetPerimeter()
    {
        $p4 = new Point(1,2);
        $c4 = new Circle(5, $p4);
        $this->assertEquals(31.4, $c4->getPerimeter());
    }

    public function testCCinIntersect()
    {
        $p5 = new Point(0,0);
        $c5 = new Circle(2, $p5);
        $p6 = new Point(1,1);
        $c6 = new Circle(3, $p5); 
        $intersector = new CircleWithCircleIntersector();       
        $this->assertEquals(true, $intersector->isIntersect($c5, $c6));
    }

}
