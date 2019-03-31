<?php
/**
 * Created by PhpStorm.
 * User: huangyongkeng
 * Date: 2019/3/26
 * Time: 11:30 AM
 */

namespace app\home\controller;
use think\Controller;
use Elasticsearch\ClientBuilder;

class Elasticsearch extends Controller{
    public function _initialize()
    {
        $hosts = [
            '47.101.135.55:9200' //ip和端口
        ];
        $this->client = ClientBuilder::create()->setHosts($hosts)->build();
    }

    //索引(创建)一个文档
    public function createDoc(){
        $params = [
            'index' => 'my_index',
            'type' => 'my_type',
            'id' => 'my_id',
            'body' => ['testField' => 'abc']
        ];

        $response = $this->client->index($params);
        print_r($response);
    }

    //搜索一个文档
    public function searchDoc(){
        $params = [
            'index' => 'my_index',
            'type' => 'my_type',
            'body' => [
                'query' => [
                    'match' => [
                        'testField' => 'abc'
                    ]
                ]
            ]
        ];

        $response = $this->client->search($params);
        print_r($response);
    }

    //删除一个文档
    public function delDoc(){
        $params = [
            'index' => 'my_index',
            'type' => 'my_type',
            'id' => 'my_id'
        ];
        $response = $this->client->delete($params);
        print_r($response);
    }

    //删除一个索引
    public function delIndex(){
        $deleteParams = [
            'index' => 'my_index'
        ];
        $response = $this->client->indices()->delete($deleteParams);
        print_r($response);
    }

    //创建一个索引
    public function createIndex(){
        $params = [
            'index' => 'my_index',
            'body' => [
                'settings' => [
                    'number_of_shards' => 2,
                    'number_of_replicas' => 0
                ]
            ]
        ];
        $response = $this->client->indices()->create($params);
        print_r($response);
    }

}