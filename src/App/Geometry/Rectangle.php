<?php
namespace App\Geometry;

class Rectangle implements ShapeInterface
{
    const NAME = 'Rectangle';

    /**
     * @var Point
     */
    private $leftTop;

    /**
     * @var Point
     */
    private $rightBottom;
   
    /**
     * @var Point
     */
    private $center;

    /**
     * @var Point
     */
    private $leftBottom;

    /**
     * @var Point
     */
    private $rightTop;

    public function __construct(Point $leftTop, Point $rightBottom)
    {
        $this->leftTop = $leftTop;
        $this->rightBottom = $rightBottom;
        $this->leftBottom = new Point(($this->getLeftTop()->getX()), ($this->getRightBottom()->getY()));
        $this->rightTop = new Point(($this->getRightBottom()->getX()), ($this->getLeftTop()->getY()));
        $this->center = new Point(($this->leftTop->getX() + $this->rightBottom->getX()) / 2, ($this->leftTop->getY() + $this->rightBottom->getY()) / 2);
     }

    /**
     * @return string
     */
    public function getName(): string 
    {
        return SELF::NAME;
    }

    /**
     * @return float
     */
    public function getWidth(): float
    {
        return $this->rightBottom->getX() - $this->leftTop->getX();
    }

    /**
     * @return float
     */
    public function getHeight(): float
    {
        return $this->leftTop->getY() - $this->rightBottom->getY();
    }

    /**
     * @return float
     */
    public function getArea(): float
    {
        return $this->getWidth() * $this->getHeight();
    }
    
    /**
     * @return float
     */
    public function getPerimeter(): float
    {
        return 2 * ($this->getWidth() + $this->getHeight());
    }    

    /**
     * @return float
     */
    public function getDiagonal(): float
    {
        return sqrt(
            pow($this->getWidth(), 2) + pow($this->getHeight(), 2)
        );
    }

    public function getCenter(): Point
    {
        return $this->center;
    }

    public function getLeftTop(): Point
    {
        return $this->leftTop;
    }

    public function getRightTop(): Point
    {
        return $this->rightTop;
    }

    public function getLeftBottom(): Point
    {
        return $this->leftBottom;
    }

    public function getRightBottom(): Point
    {
        return $this->rightBottom;
    }
}
