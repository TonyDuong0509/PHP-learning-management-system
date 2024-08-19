<?php

namespace App\Repositories;

use App\Models\Course;
use App\Repositories\Interfaces\CourseRepositoryInterface;

class CourseRepository implements CourseRepositoryInterface
{
    public function fetchAll($condition = null)
    {
        global $conn;
        $courses = array();
        $sql = "SELECT * FROM courses";
        if ($condition) {
            $sql .= " WHERE $condition";
        }
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $course = new Course(
                    $row['id'],
                    $row['category_id'],
                    $row['subcategory_id'],
                    $row['instructor_id'],
                    $row['image'],
                    $row['title'],
                    $row['name'],
                    $row['slug'],
                    $row['description'],
                    $row['video'],
                    $row['duration'],
                    $row['selling_price'],
                    $row['discount_price'],
                    $row['prerequisuites'],
                    $row['bestseller'],
                    $row['featured'],
                    $row['highestrated'],
                    $row['status'],
                    $row['created_at'],
                    $row['certificate'],
                    $row['resources'],
                    $row['label'],
                    $row['type_id'],
                );
                $courses[] = $course;
            }
        }
        return $courses;
    }

    public function getById($id)
    {
        $condition = "id = '$id'";
        $courses = $this->fetchAll($condition);
        $course = current($courses);
        return $course;
    }

    public function save($data)
    {
        global $conn;
        $category_id = $data['category_id'];
        $subcategory_id = $data['subcategory_id'];
        $instructor_id = $data['instructor_id'];
        $name = $conn->real_escape_string($data['name']);
        $title = $conn->real_escape_string($data['title']);
        $slug = $conn->real_escape_string($data['slug']);
        $certificate = $data['certificate'];
        $label = $data['label'];
        $selling_price = $data['selling_price'];
        $discount_price = $data['discount_price'];
        $duration = $data['duration'];
        $resources = $conn->real_escape_string($data['resources']);
        $prerequisites = $conn->real_escape_string($data['prerequisites']);
        $description = $conn->real_escape_string($data['description']);
        $bestseller = $data['bestseller'];
        $featured = $data['featured'];
        $highestrated = $data['highestrated'];
        $created_at = $data['created_at'];
        $image = $data['image'];
        $video = $data['video'];
        $status = 1;
        $type_id = $data['type_id'];

        $sql = "INSERT INTO courses (category_id, subcategory_id, instructor_id,
                                name, title, slug, certificate ,description, duration, selling_price,
                                discount_price, prerequisuites, bestseller, featured, highestrated,
                                status, created_at, image, video, label, resources, type_id)
                VALUES ('$category_id', '$subcategory_id', '$instructor_id', '$name', '$title',
                        '$slug', '$certificate', '$description', '$duration', '$selling_price',
                        '$discount_price', '$prerequisites', '$bestseller', '$featured', '$highestrated',
                        '$status', '$created_at', '$image', '$video', '$label', '$resources', '$type_id')";

        if ($conn->query($sql) === true) {
            $last_id = $conn->insert_id;
            return $last_id;
        }
        echo "Error: " . $sql . PHP_EOL;
        return false;
    }

    public function update($course)
    {
        global $conn;

        $id = $course->getId();
        $name = $course->getName();
        $title = $course->getTitle();
        $slug = $course->getSlug();
        $category_id = $course->getCategoryId();
        $subcategory_id = $course->getSubcategoryId();
        $certificate = $course->getCertificate();
        $label = $course->getLabel();
        $selling_price = $course->getSellingPrice();
        $discount_price = $course->getDiscountPrice();
        $duration = $course->getDuration();
        $resources = $conn->real_escape_string($course->getResources());
        $prerequisuites = $conn->real_escape_string($course->getPrerequisuites());
        $description = $conn->real_escape_string($course->getDescription());
        $bestseller = $course->getBestseller();
        $featured = $course->getFeatured();
        $highestrated = $course->getHighestrated();
        $image = $course->getImage();
        $video = $course->getVideo();
        $type_id = $course->getTypeId();

        $sql = "UPDATE courses
                SET category_id = '$category_id', subcategory_id = '$subcategory_id', title = '$title',
                    name = '$name', slug = '$slug', description = '$description', duration = '$duration',
                    selling_price = '$selling_price', discount_price = '$discount_price', prerequisuites = '$prerequisuites',
                    bestseller = '$bestseller', featured = '$featured', highestrated = '$highestrated', certificate = '$certificate',
                    resources = '$resources', label = '$label', image = '$image', video = '$video', type_id = '$type_id'
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

        $sql = "DELETE FROM courses WHERE id = '$id'";

        if ($conn->query($sql) === true) {
            return true;
        }
        echo "Error: " . $sql . PHP_EOL;
        return false;
    }
}
