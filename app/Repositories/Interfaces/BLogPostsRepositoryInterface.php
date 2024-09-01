<?php

namespace App\Repositories\Interfaces;

interface BLogPostsRepositoryInterface
{
    public function fetchAll($condition = null);
    public function getAllPosts();
    public function save($params);
    public function getById($id);
    public function update($post);
    public function delete($id);
    public function getBySlug($slug);
    public function getAllByBlogCid($id);
}
