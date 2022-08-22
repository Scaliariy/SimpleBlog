<?php

class BlogPost
{

public $id;
public $title;
public $post;
public $author;
public $tags;
public $grade;
public $datePosted;

function __construct(mysqli $connection, $inId=null, $inTitle=null, $inPost=null, $inAuthorId=null, $inGrade=null, $inDatePosted=null)
{
	if (!empty($inId))
	{
		$this->id = $inId;
	}
	if (!empty($inTitle))
	{
		$this->title = $inTitle;
	}
	if (!empty($inPost))
	{
		$this->post = $inPost;
	}
	if (!empty($inGrade))
	{
		$this->grade = $inGrade;
	}

	if (!empty($inDatePosted))
	{
		$splitDate = explode("-", $inDatePosted);
		$this->datePosted = $splitDate[1] . "/" . $splitDate[2] . "/" . $splitDate[0];
	}

	if (!empty($inAuthorId))
	{
		$query = mysqli_query($connection,"SELECT first_name, last_name FROM people WHERE id = " . $inAuthorId);
		$row = mysqli_fetch_assoc($query);
		$this->author = $row["first_name"] . " " . $row["last_name"];
	}

	$postTags = "No Tags";
	if (!empty($inId))
	{
		$query = mysqli_query($connection,"SELECT tags.* FROM blog_post_tags LEFT JOIN (tags) ON (blog_post_tags.tag_id = tags.id) WHERE blog_post_tags.blog_post_id = " . $inId);
		$tagArray = array();
		$tagIDArray = array();
		while($row = mysqli_fetch_assoc($query))
		{
			array_push($tagArray, $row["name"]);
			array_push($tagIDArray, $row["id"]);
		}
		if (sizeof($tagArray) > 0)
		{
			foreach ($tagArray as $tag)
			{
				if ($postTags == "No Tags")
				{
					$postTags = $tag;
				}
				else
				{
					$postTags = $postTags . ", " . $tag;
				}
			}
		}
	}
	$this->tags = $postTags;
}

}

