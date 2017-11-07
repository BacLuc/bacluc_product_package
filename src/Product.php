<?php
/**
 * Created by PhpStorm.
 * User: lucius
 * Date: 01.02.16
 * Time: 23:08
 */

namespace Concrete\Package\BaclucProductPackage\Src;

use Concrete\Package\BasicTablePackage\Src\BaseEntity;
use Concrete\Package\BasicTablePackage\Src\BaseEntityRepository;
use Concrete\Package\BasicTablePackage\Src\DiscriminatorEntry\DiscriminatorEntry;
use Concrete\Package\BasicTablePackage\Src\EntityGetterSetter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\InheritanceType;


/*because of the hack with @DiscriminatorEntry Annotation, all Doctrine Annotations need to be
properly imported*/

/**
 * Class Product
 * Package  Concrete\Package\BaclucProductPackage\Src
 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="discr", type="string")
 * @DiscriminatorEntry(value="Concrete\Package\BaclucProductPackage\Src\Product")
 * @Entity
@Table(name="bacluc_product"
 * )
 *
 */
class Product extends BaseEntity
{
    use EntityGetterSetter;
    /**
     * @var int
     * @Id @Column(type="integer", nullable=false, options={"unsigned":true})
     * @GEneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Column(type="string")
     */
    protected $code;

    /**
     * @Column(type="string")
     */
    protected $name;

    /**
     * @Column(type="float")
     */
    protected $price;


    public function __construct()
    {
        parent::__construct();


        if ($this->OldVersions == null) {
            $this->OldVersions = new ArrayCollection();
        }
        $this->setDefaultFieldTypes();
    }

    public function setDefaultFieldTypes()
    {
        parent::setDefaultFieldTypes();

        //$this->fieldTypes['NewVersion']->setShowInForm(false);


    }


    /**
     * Returns the function, which generates the String for LInk Fields to identify the instance. Has to be unique to prevent errors
     * @return \Closure
     */
    public static function getDefaultGetDisplayStringFunction()
    {
        $function = function (Product $item) {
            $item = BaseEntityRepository::getBaseEntityFromProxy($item);
            $returnString = '';
            if (strlen($item->code) > 0) {
                $returnString .= $item->code . " ";
            }
            if (strlen($item->name) > 0) {
                $returnString .= $item->name . " ";
            }
            if (strlen($item->price) != 0) {
                $returnString .= $item->price . " ";
            }
            return $returnString;
        };
        return $function;
    }


}