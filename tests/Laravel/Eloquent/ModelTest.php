<?php

namespace Tests\DeeToo\Essentials\Laravel\Eloquent\Types;

use DateTime;
use DeeToo\Essentials\ValueObjects\Country;
use DeeToo\Essentials\ValueObjects\Currency;
use DeeToo\Essentials\ValueObjects\Temperature;
use Illuminate\Support\Composer;
use Tests\Illuminate\Database\Eloquent\TestModel;
use Tests\TestCase;

/**
 * Class ArrayTypeTest
 *
 * @package Tests\DeeToo\Essentials\Laravel\Eloquent\Types
 */
class ModelTest extends TestCase
{
    public function setUp()
    {
        require_once("TestModel.php");

        parent::setUp();
    }

    public function test_to_primitive()
    {
        $model = new TestModel();

        $model->boolean     = 'on';
        $model->integer     = 22;
        $model->float       = '2';
        $model->string      = '2';
        $model->date        = '2017-01-02';
        $model->datetime    = '2017-01-02 00:00:00';
        $model->email       = 'jordan.dobrev.88@gmail.com';
        $model->enumerable  = 'one';
        $model->array       = ['one'];
        $model->object      = ['object'];
        $model->text        = 'adat';
        $model->url         = 'http://www.abv.bg';
        $model->country     = 'GB';
        $model->vo          = 'bgn';
        $model->temp        = 12;
        $model->relation_id = '1';

        $this->assertInternalType('boolean', $model->boolean);
        $this->assertInternalType('integer', $model->integer);
        $this->assertInternalType('float', $model->float);
        $this->assertInternalType('string', $model->string);
        $this->assertInstanceOf(DateTime::class, $model->date);
        $this->assertInstanceOf(DateTime::class, $model->datetime);
        $this->assertInternalType('string', $model->email);
        $this->assertInternalType('string', $model->enumerable);
        $this->assertInternalType('array', $model->array);
        $this->assertInternalType('object', $model->object);
        $this->assertInternalType('string', $model->text);
        $this->assertInternalType('string', $model->url);
        $this->assertInstanceOf(Country::class, $model->country);
        $this->assertInstanceOf(Currency::class, $model->vo);
        $this->assertInstanceOf(Temperature::class, $model->temp);
        $this->assertInternalType('string', $model->relation_id);

        $relation     = new TestModel();
        $relation->id = '2';

        $model->relation()->associate($relation);

        $this->assertInternalType('string', $model->relation_id);

        $array = $model->toArray();

        $this->assertInternalType('boolean', $array['boolean']);
        $this->assertInternalType('integer', $array['integer']);
        $this->assertInternalType('float', $array['float']);
        $this->assertInternalType('string', $array['string']);
        $this->assertInternalType('string', $array['date']);
        $this->assertInternalType('string', $array['datetime']);
        $this->assertInternalType('string', $array['email']);
        $this->assertInternalType('string', $array['enumerable']);
        $this->assertInternalType('array', $array['array']);
        $this->assertInternalType('array', $array['object']);
        $this->assertInternalType('string', $array['text']);
        $this->assertInternalType('string', $array['url']);
        $this->assertInternalType('string', $array['country']);
        $this->assertInternalType('string', $array['vo']);
        $this->assertInternalType('integer', $array['temp']);
        $this->assertInternalType('string', $array['relation_id']);

        $model = new TestModel();

        $model->boolean     = null;
        $model->integer     = null;
        $model->float       = null;
        $model->string      = null;
        $model->date        = null;
        $model->datetime    = null;
        $model->email       = null;
        $model->enumerable  = null;
        $model->array       = null;
        $model->object      = null;
        $model->text        = null;
        $model->url         = null;
        $model->country     = null;
        $model->vo          = null;
        $model->temp        = null;
        $model->relation_id = null;

        $this->assertNull($model->boolean);
        $this->assertNull($model->integer);
        $this->assertNull($model->float);
        $this->assertNull($model->string);
        $this->assertNull($model->date);
        $this->assertNull($model->datetime);
        $this->assertNull($model->email);
        $this->assertNull($model->enumerable);
        $this->assertNull($model->array);
        $this->assertNull($model->object);
        $this->assertNull($model->text);
        $this->assertNull($model->url);
        $this->assertNull($model->country);
        $this->assertNull($model->vo);
        $this->assertNull($model->temp);
        $this->assertNull($model->relation_id);

        $array = $model->toArray();

        $this->assertNull($array['boolean']);
        $this->assertNull($array['integer']);
        $this->assertNull($array['float']);
        $this->assertNull($array['string']);
        $this->assertNull($array['date']);
        $this->assertNull($array['datetime']);
        $this->assertNull($array['email']);
        $this->assertNull($array['enumerable']);
        $this->assertNull($array['array']);
        $this->assertNull($array['object']);
        $this->assertNull($array['text']);
        $this->assertNull($array['url']);
        $this->assertNull($array['country']);
        $this->assertNull($array['vo']);
        $this->assertNull($array['temp']);
        $this->assertNull($array['relation_id']);
    }

    /**
     * @expectedException \DeeToo\Essentials\Exceptions\Error
     * @expectedExceptionMessage read_only is read-only
     */
    public function test_read_only()
    {
        $model = new TestModel();

        $this->assertArrayNotHasKey('read_only', $model->getFillable());

        $model->read_only = '123';
    }

    public function test_allow_read_only_if_unguarded()
    {
        $model = new TestModel();

        TestModel::unguard(true);

        $model->read_only = '123';

        $this->assertNotEmpty($model->read_only);
    }
}
