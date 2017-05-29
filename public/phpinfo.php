<?php
/**
 * Created by PhpStorm.
 * User: hupo
 * Date: 2017/5/21
 * Time: 下午5:21
 */
//echo phpinfo();
function p($value)
{
    echo "<pre>";
    print_r($value);
    echo "</pre>";

}

class A{
    public function __construct()
    {
        echo __METHOD__;

    }
}

class B{
    protected $do;
    public function __construct($rd)
    {
//        p($rd);
        $this->do = $rd;
//        p($this->do);
    }
    public function show(){
        echo "is b show";
    }
}
echo "1111";
$name = array('1','2');
$data = new B(new A);
$data->show();