<?php

namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index(){

        /*
         * php Spl的几种数据结构
         */

        //1、spl 栈数据结构
        /*$splStack = new \SplStack(); //栈数据结构【先进后出】
        $splStack->push("push1\n");
        $splStack->push("push2\n");
        echo $splStack->pop();
        echo "<br/>";
        echo $splStack->pop();*/

        //2、spl 队列数据结构 【先进先出，后进后出】
        /*$splQueue = new \SplQueue();
        $splQueue->enqueue("push1");
        $splQueue->enqueue("push2");
        echo $splQueue->dequeue();
        echo "<br/>";
        echo $splQueue->dequeue();*/

        //3、spl 堆数据结构
        /*$splMinHeap = new \SplMinHeap();
        $splMinHeap->insert("splMinHeap1\n");
        $splMinHeap->insert("splMinHeap2\n");
        echo $splMinHeap->extract();
        echo "<br/>";
        echo $splMinHeap->extract();*/

        //4、固定长度的数组
        /*$splFixedArray = new \SplFixedArray(10);
        $splFixedArray[0] = 'xiaojunming';
        $splFixedArray[5] = '哈哈';
        print_r($splFixedArray);*/




       /* $user = M( 'User' );
        $data = $user->select();
        print_r($data);*/
    }
}