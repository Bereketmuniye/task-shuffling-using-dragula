<?php

namespace App;

class Node
{
    public $data;
    public $next;

    public function __construct($data)
    {
        $this->data = $data;
        $this->next = null;
    }
}

class LinkedList
{
    private $head;

    public function __construct()
    {
        $this->head = null;
    }

    public function insert($data)
    {
        $newNode = new Node($data);
        if ($this->head === null) {
            $this->head = $newNode;
        } else {
            $current = $this->head;
            while ($current->next !== null) {
                $current = $current->next;
            }
            $current->next = $newNode;
        }
    }

    public function toArray()
    {
        $array = [];
        $current = $this->head;
        while ($current !== null) {
            $array[] = $current->data;
            $current = $current->next;
        }
        return $array;
    }

    public function remove($index)
    {
        if ($this->head === null) return;

        if ($index === 0) {
            $this->head = $this->head->next;
            return;
        }

        $current = $this->head;
        $previous = null;
        $count = 0;

        while ($current !== null && $count < $index) {
            $previous = $current;
            $current = $current->next;
            $count++;
        }

        if ($previous !== null && $current !== null) {
            $previous->next = $current->next;
        }
    }

    public function rearrange($newOrder)
    {
        $nodes = [];
        $current = $this->head;

        // Store nodes in an array
        while ($current !== null) {
            $nodes[] = $current;
            $current = $current->next;
        }

        // Reorder nodes based on new order
        $newHead = null;
        $previous = null;

        foreach ($newOrder as $index) {
            $index = (int)$index;
            if (isset($nodes[$index])) {
                if ($newHead === null) {
                    $newHead = $nodes[$index];
                } else {
                    $previous->next = $nodes[$index];
                }
                $previous = $nodes[$index];
            }
        }

        // Terminate the new list
        if ($previous !== null) {
            $previous->next = null;
        }

        $this->head = $newHead;
    }
}