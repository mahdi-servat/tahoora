<?php

namespace Mmwdali\ContainerBuilder;

use Nette\PhpGenerator\PhpFile;
use Illuminate\Http\Request;

class Generator
{

    public static function run($name)
    {
        $ActionDirMain = app_path('Actions');
        $ActionDirMain = str_replace('\\' , '/' , $ActionDirMain );

        if (!is_dir($ActionDirMain)) {
            mkdir($ActionDirMain);
        }
        $ActionDir = app_path('Actions\\'.$name);
        $ActionDir = str_replace('\\' , '/' , $ActionDir );

        if (!is_dir($ActionDir)) {
            mkdir($ActionDir);
        }
        $arr = array('Create', 'Delete', 'Find', 'GetAll', 'Update');
        foreach ($arr as $item) {
            $nSpace = "App\\Actions\\" . $name ;
            $className = $item . $name . "Action";
            $file = new PhpFile();
            $file->addComment('Actions are class for process');
            $namespace = $file->addNamespace($nSpace);
            $namespace->addUse('Illuminate\Support\Facades\App');
            $namespace->addUse('Illuminate\Http\Request');

            $rep = "App\\Repositories\\" . $name . "RepositoryEloquent";
            $namespace->addUse($rep);


            $class = $namespace->addClass($className);
            $class->addProperty('repository');

            $methodConstruct = $class->addMethod('__construct');
            $repClass = "App\\Repositories\\" . $name . "RepositoryEloquent";
            $methodConstruct->setBody('$this->repository = App::make(' . $name .'RepositoryEloquent::class);');

            $methodHandle = $class->addMethod('handle');
            $requestType = "Illuminate\\Http\\Request" ;
            $methodHandle->addParameter('request')->setType($requestType);

            $dir2 = $ActionDir . '/' . $className . '.php';
            $dir = fopen($dir2, 'w');
            fwrite($dir, $file);
        }

//        $arr1 = array('index' , 'create' , 'store' , 'edit' , 'update' , 'delete');
//        $nSpaceController = "App\\Http\\Controllers\\web\\" . $name ;
//        $controllerDir = str_replace('\\' , '/' , app_path('Http\\Controllers\\web'));
//        if (!is_dir($controllerDir)){
//            mkdir($controllerDir);
//        }
//        $className = $name . "Controller";
//        $file = new PhpFile();
//        $namespace = $file->addNamespace($nSpaceController);
//        foreach($arr1 as $item){
//
//        }
//        return true;
    }
}
