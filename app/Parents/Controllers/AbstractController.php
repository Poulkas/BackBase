<?php

namespace App\Parents\Controllers;

use Illuminate\Routing\Controller as BaseController;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use App\Ship\Serializer\DataSerializer;
use App\Ship\Transformer\ResponseTransformer;
use Request;
use Exception;

abstract class AbstractController extends BaseController {

    public function callActionMethod($object, String $method, $request, ...$mixed){
        try{
            return call_user_func(array($object, $method), $request, ...$mixed);
        }catch(Exception $e){
            throw $e;
        }
    }

    public function transform(String $method, $model, $transformer, Request $request = null){
        $fractal = $this->_getFractal();
        $resource = call_user_func(array($this, $method), $model, $transformer, $request);
        return $fractal->createData($resource)->toArray();
    }

    public function item($item, $transformer){
        return new Item($item, $transformer);
    }

    public function collection($collection, $transformer){
        return new Collection($collection, $transformer);
    }

    public function paginate($model, $transformer, Request $request = null){
        $paginator = $this->_getPaginator($model, $request);
        $resource = new Collection($paginator->getCollection(), $transformer);
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));
        return $resource;
    }

    public function response($data = null, $message = null, $code = 200){
        return $this->_response($data, $message, $code);
    }

    public function errorResponse($message = null, $data = null, $code = 422){
        return $this->_response($data, $message, $code);
    }

    private function _getFractal(){
        $fractal = new Manager();
        $fractal->setSerializer(new DataSerializer);
        if(isset($_GET['include'])) {
            $fractal->parseIncludes($_GET['include']);
        }
        return $fractal;
    }

    private function _getPaginator($model, Request $request = null){
        $limit = 15;
        if($request!==null){
            if($request->input('limit') && is_numeric($request->input('limit'))){
                $limit = $request->input('limit');
            }
        }
        return $model->paginate($limit);
    }

    private function _response($data, $message, $code){
        $fractal = $this->_getFractal();
        $resource = $this->_getResponseData($data, $message, $code);
        return $fractal->createData($resource)->toJson();
    }

    private function _getResponseData($data, $message, $code){
        $resource = $this->item($data, new ResponseTransformer());
        $meta = $resource->getMeta();
        if($message!==null){
            $meta['message'] = $message;
        }
        if($code!==null && $code!==0){
            $meta['code'] = $code;
        }
        $resource->setMeta($meta);
        return $resource;
    }
}
