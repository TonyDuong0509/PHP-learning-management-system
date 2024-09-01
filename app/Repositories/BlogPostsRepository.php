<?php

namespace App\Repositories;

use App\Models\BlogPosts;
use App\Repositories\Interfaces\BLogPostsRepositoryInterface;

class BlogPostsRepository implements BLogPostsRepositoryInterface
{
    public function fetchAll($condition = null)
    {
        global $conn;
        $blogPosts = array();

        $sql = "SELECT * FROM blog_posts";
        if ($condition) {
            $sql .= " WHERE $condition";
        }
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $blogPost = new BlogPosts($row['id'], $row['blogcategory_id'], $row['post_title'], $row['post_slug'], $row['post_image'], $row['description'], $row['post_tags'], $row['created_at']);
                $blogPosts[] = $blogPost;
            }
        }
        return $blogPosts;
    }

    public function getAllPosts()
    {
        $condition = "id != '' ORDER BY id DESC";
        return $this->fetchAll($condition);
    }

    public function getPostsLimit()
    {
        $condition = "id != '' ORDER BY id DESC LIMIT 3";
        return $this->fetchAll($condition);
    }

    public function save($params)
    {
        global $conn;

        $blogcategory_id = $params['blogcategory_id'];
        $post_title = $conn->real_escape_string($params['post_title']);
        $post_slug = $conn->real_escape_string($params['post_slug']);
        $post_image = $params['post_image'];
        $description = $conn->real_escape_string($params['description']);
        $post_tags = $conn->real_escape_string($params['post_tags']);
        $created_at = $params['created_at'];

        $sql = "INSERT INTO blog_posts (blogcategory_id, post_title, post_slug, post_image, description, post_tags, created_at)
                VALUES ('$blogcategory_id', '$post_title', '$post_slug', '$post_image', '$description', '$post_tags', '$created_at')";
        if ($conn->query($sql) === true) {
            $last_id = $conn->insert_id;
            return $last_id;
        }
        echo "Error: " . $sql . PHP_EOL;
        return false;
    }

    public function getById($id)
    {
        $condition = "id = '$id'";
        $posts = $this->fetchAll($condition);
        $post = current($posts);
        return $post;
    }

    public function getAllByBlogCid($id)
    {
        $condition = "blogcategory_id = '$id' LIMIT 6";
        return $this->fetchAll($condition);
    }

    public function getBySlug($slug)
    {
        $condition = "post_slug = '$slug' LIMIT 1";
        $posts = $this->fetchAll($condition);
        $post = current($posts);
        return $post;
    }

    public function update($post)
    {
        global $conn;

        $id = $post->getId();
        $blogcategory_id = $post->getBlogCategoryId();
        $post_title = $conn->real_escape_string($post->getPostTitle());
        $post_slug = $conn->real_escape_string($post->getPostSlug());
        $post_image = $post->getPostImage();
        $description = $conn->real_escape_string($post->getDescription());
        $post_tags = $conn->real_escape_string($post->getPostTags());
        $created_at = $post->getCreatedAt();

        $sql = "UPDATE blog_posts
                SET blogcategory_id = '$blogcategory_id', post_title = '$post_title', post_slug = '$post_slug', post_image = '$post_image', description = '$description', post_tags = '$post_tags', created_at = '$created_at'
                WHERE id = '$id'";

        if ($conn->query($sql) === true) {
            return true;
        }
        echo "Error: " . $sql . PHP_EOL;
        return false;
    }

    public function delete($id)
    {
        global $conn;

        $sql = "DELETE FROM blog_posts
                WHERE id = '$id'";
        if ($conn->query($sql) === true) {
            return true;
        }
        echo "Error: " . $sql . PHP_EOL;
        return false;
    }
}
