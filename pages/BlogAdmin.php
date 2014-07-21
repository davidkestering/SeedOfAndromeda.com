<?php
if (! isset ( $_REQUEST ['notemplate'] )) {
	echo '<div id="single-blog" class="double-col">';
}
if (! $loggedIn) {
	echo '<h3 style="color: red; text-shadow: 0px 0px 10px rgba(255, 0, 0, 1);">Login requred to access this page!</h3>';
} else {
	if (! isset ( $connection )) {
		echo '<h3 style="color: red; text-shadow: 0px 0px 10px rgba(255, 0, 0, 1);">No database connection!</h3>';
	} else {
		// var_dump ( $userinfo );
		
		$groups = explode ( ",", $userinfo ["secondary_group_ids"] );
		$groups [] = $userinfo ["user_group_id"];
		
		$caneditown = false;
		$caneditall = false;
		
		// Groups that can edit/delete own posts:
		$editowngroups = array (
				7,
				13 
		); // 7 = Dev member, 13 = Dev leader
		   
		// Groups that can edit/delete all posts:
		$editallgroups = array (
				3 
		); // 3 = Admins
		
		foreach ( $editallgroups as $groupid ) {
			if (in_array ( $groupid, $groups )) {
				$caneditall = true;
				$caneditown = true;
				break;
			}
		}
		if (! $caneditown) {
			foreach ( $editowngroups as $groupid ) {
				if (in_array ( $groupid, $groups )) {
					$caneditall = true;
					$caneditown = true;
					break;
				}
			}
		}
		if (! $caneditown && ! $caneditall) {
			echo '<h3 style="color: red; text-shadow: 0px 0px 10px rgba(255, 0, 0, 1);">You don\'t have permissions to view this page!</h3>';
		} else {
            if (isset ( $_REQUEST ['delete'] )) {
                $blogpost = false;
                if ($caneditall) {
					$query = $connection->prepare ( "SELECT * FROM blog_posts WHERE id = ?" );
					$query->execute ( array (
							$_REQUEST ['postid'] 
					) );
					$blogpost = $query->fetch ();
				} elseif ($caneditown) {
					
					$query = $connection->prepare ( "SELECT * FROM blog_posts WHERE id = ? AND author = ?" );
					$query->execute ( array (
							$_REQUEST ['postid'],
							$userinfo ['user_id'] 
					) );
					$blogpost = $query->fetch ();
				}
				if (! $blogpost) {
					echo '<h3 style="color: red; text-shadow: 0px 0px 10px rgba(255, 0, 0, 1);">Blog post not found or you don\'t have permissions to delete it!</h3><br /><a style="color: white !important;" href="/' . $pageurl . '">Return</a>';
                } else {
                    $query = $connection->prepare ( "DELETE FROM blog_posts WHERE id = ?" );
                    $query->execute ( array (
                            $_REQUEST ['postid']
                    ) );
                    echo '<div style="text-align:center;width:100%;"><h3><a style="color: white !important;" href="/' . $pageurl . '">Return</a></h3></div>';
                }
            } else if (isset ( $_REQUEST ['postid'] )) {
				$blogpost = false;
				if ($caneditall) {
					$query = $connection->prepare ( "SELECT * FROM blog_posts WHERE id = ?" );
					$query->execute ( array (
							$_REQUEST ['postid'] 
					) );
					$blogpost = $query->fetch ();
				} elseif ($caneditown) {
					
					$query = $connection->prepare ( "SELECT * FROM blog_posts WHERE id = ? AND author = ?" );
					$query->execute ( array (
							$_REQUEST ['postid'],
							$userinfo ['user_id'] 
					) );
					$blogpost = $query->fetch ();
				}
				if (! $blogpost) {
					echo '<h3 style="color: red; text-shadow: 0px 0px 10px rgba(255, 0, 0, 1);">Blog post not found or you don\'t have permissions to edit it!</h3>';
				} else {
					if (isset ( $_REQUEST ['submit'] )) {
						// var_dump ( $_REQUEST );
						if (! isset ( $_REQUEST ['blog-post-title'] ) || ! isset ( $_REQUEST ['blog-post-content'] )) {
							echo '<h3 style="color: red; text-shadow: 0px 0px 10px rgba(255, 0, 0, 1);">Blog post title and body are required!</h3>';
						} else {
							$query = $connection->prepare ( "UPDATE blog_posts SET title = ?, post_body = ?, updatetime = ?, disablecomments = ?, published = ?, devnews = ?, anonymous = ?, removesignoff = ?, dev_news_body = ?, dev_news_background = ? WHERE id = ?" );
							$query->execute ( array (
									$_REQUEST ['blog-post-title'],
									$_REQUEST ['blog-post-content'],
									time (),
									isset ( $_REQUEST ['commentsoff'] ) && $_REQUEST ['commentsoff'] == 1,
									isset ( $_REQUEST ['publish'] ) && $_REQUEST ['publish'] == 1,
									isset ( $_REQUEST ['devnews'] ) && $_REQUEST ['devnews'] == 1,
									isset ( $_REQUEST ['anonymous'] ) && $_REQUEST ['anonymous'] == 1,
									isset ( $_REQUEST ['no-sign-off'] ) && $_REQUEST ['no-sign-off'] == 1,
                                    $_REQUEST ['dev-news-summary-content'],
                                    $_REQUEST ['dev-news-summary-background'],
									$_REQUEST ['postid'],
							) );
							header ( "Location: /" . $pageurl . "?postid=" . $_REQUEST ['postid'] );
						}
					} else {
						$author = $sdk->getUser ( $blogpost ["author"] );
						?>
<script src="./tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
    selector: "div.editpost",
    //theme: "modern",
    skin: "darktheme",
    plugins: [
              "advlist autolink lists link image charmap hr anchor pagebreak",
              "searchreplace wordcount visualblocks visualchars code fullscreen",
              "insertdatetime media nonbreaking save table contextmenu directionality",
              "emoticons template paste textcolor"
          ],
    external_plugins: {
        "jbimages": "/jbimages/plugin.min.js"
    },
    toolbar1: "bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | blockquote code",
    //toolbar2: "blockquote code | emoticons link media image jbimages",
    contextmenu: "link image jbimages inserttable | cut copy paste | cell row column deletetable",
    image_advtab: true,
    add_unload_trigger: false,
    inline: true,
    statusbar: false,
    browser_spellcheck : true,
    relative_urls: false,
    remove_script_host: true,
    document_base_url: "/blogs/",
    image_class_list: [
                       {title: 'None', value: 'blog-inline-image'},
                       { title: 'Large', value: 'large blog-inline-image' },
                       { title: 'X-large', value: 'x-large blog-inline-image' },
                       { title: 'XX-large', value: 'xx-large blog-inline-image' },
                       { title: 'XXX-large', value: 'xxx-large blog-inline-image' },
                       { title: 'Large wide', value: 'large-wide blog-inline-image' },
                       { title: 'X-large wide', value: 'x-large-wide blog-inline-image' },
                       { title: 'XX-large wide', value: 'xx-large-wide blog-inline-image' },
                       { title: 'XXX-large wide', value: 'xxx-large-wide blog-inline-image' }
                   ],
    image_list: [
                 <?php
						foreach ( glob ( "Assets/images/Blogs/*.*" ) as $filename ) {
							$file = pathinfo ( $filename );
							if ($file ["extension"] == "jpg" || $file ["extension"] == "png" || $file ["extension"] == "gif") {
								echo "{title: '" . $file ["basename"] . "', value: '/Assets/images/Blogs/" . $file ["basename"] . "'},";
							}
						}
						
						?>
    ],
});
    tinymce.init({
        selector: "p.edittitle",
        theme: "modern",
        inline: true,
        plugins: [
                  "save"
              ],
        toolbar: "save undo redo",
        statusbar: false,
        menubar: false,
        valid_elements : "dummyelem"
    });
    </script>
<form
	action="/<?php echo $pageurl . '?postid=' . $blogpost ["id"]; ?>&submit&notemplate"
	method="post">
	<div id="blog-post-header">
		<p id="blog-post-title" class="edittitle"><?php echo $blogpost["title"];?></p>
	</div>
	<div id="blog-post-body" style="padding-top: 40px;">
		<div class="editpost" id="blog-post-content"><?php echo $blogpost["post_body"];?></div>
	</div>
	<div id="blog-post-footer">
		<p>
			<?php echo $author["username"]." - ".$author["custom_title"];?>
		</p>
	</div>
    <div <?php if($blogpost["devnews"] != "1") echo "style='display: none;'";?>  id="dev-news-summary-content-cover">
        <div style="width: 100%;">
            <h2>Dev News Summary:</h2>
            <div class="editpost" id="dev-news-summary-content"><?php echo $blogpost["dev_news_body"];?></div>
        </div>
        <div style="width: 100%;">
            <h3>Dev News Background Image:</h3>
            <div class="editpost" id="dev-news-summary-background"><?php echo $blogpost["dev_news_background"];?></div>
        </div>
    </div>
    <div>
		<h3>Post settings</h3>
		<input type="checkbox" name="commentsoff" value="1"
			<?php if($blogpost["disablecomments"] == "1") echo "checked";?> />
		Disable commenting<br /> <input type="checkbox" class="publish" name="publish"
			value="1" <?php if($blogpost["published"] == "1") echo "checked";?> />
		Publish blog post<br /> <input type="checkbox" class="devnews" name="devnews"
			value="1" <?php if($blogpost["devnews"] == "1") echo "checked";?> />
		Publish blog to Dev News<br /> <input type="checkbox" class="anonymous" name="anonymous"
			value="1" <?php if($blogpost["anonymous"] == "1") echo "checked";?> />
        Publish anonymously<br /> <input type="checkbox" class="no-sign-off" name="no-sign-off"
			value="1" <?php if($blogpost["removesignoff"] == "1") echo "checked";?> />
        Publish with no sign off<br /><br /> <input type="submit" value="Save" />
        <br />
	</div>
</form>
                   <?php echo '<div style="float: right;position:absolute;right:20px;bottom:20px;"><h3 style="margin-bottom: 0;"><a style="color: white !important;" href="/' . $pageurl . '">Return</a></h3></div>'; ?>
<?php
					}
				}
			} elseif (isset ( $_REQUEST ['newpost'] )) {
				
				$query = $connection->prepare ( "INSERT INTO blog_posts (author, title, timestamp, post_body, dev_news_body, dev_news_background) VALUES (?, ?, ?, ?, ?, ?)" );
				$query->execute ( array (
						$userinfo ['user_id'],
						"New blog post",
						time (),
						"<h2>Click here to edit!</h2><p>Click the title to edit it.</p>" ,
                        "<p>Click here to edit!</p>",
                        '<p><img class="xx-large-wide blog-inline-image" src="http://www.seedofandromeda.com/Assets/images/Blogs/Default/Plains.jpg" alt="Default Dev News Background" /></p>'
				) );
				
				$id = $connection->lastInsertId ();
				header ( "Location: /" . $pageurl . "?postid=" . $id );
			} else {
				echo '<h3>Blog admin panel</h3>';
				if ($caneditown) {
					
					echo '<p><a href="/' . $pageurl . '?newpost&notemplate">New post</a></p>';
					
					$query = $connection->prepare ( "SELECT * FROM blog_posts WHERE author = ? ORDER BY id DESC" );
					$query->execute ( array (
							$userinfo ['user_id'] 
					) );
					echo "Your blog posts:<br><ul>";
					while ( $row = $query->fetch () ) {
						echo '<li>' . $row ["title"] . ' - <a href="/' . $pageurl . '?postid=' . $row ["id"] . '">Edit</a> - <a onclick="return confirmAction(\'Are you sure you wish to delete this blog?\');" href="/' . $pageurl . '?postid=' . $row ["id"] . '&delete=1">Delete</a></li>';
					}
					
					echo "</ul>";
				}
				if ($caneditall) {
					$query = $connection->prepare ( "SELECT * FROM blog_posts WHERE author != ? ORDER BY id DESC" );
					$query->execute ( array (
							$userinfo ['user_id'] 
					) );
					
					echo "Blog posts by others:<br><ul>";
					while ( $row = $query->fetch () ) {
						$author = $sdk->getUser ( $row ["author"] );
						echo '<li>' . $row ["title"] . ' by ' . $author ["username"] . ' - <a href="/' . $pageurl . '?postid=' . $row ["id"] . '">Edit</a> - <a onclick="return confirmAction(\'Are you sure you wish to delete this blog?\');" href="/' . $pageurl . '?postid=' . $row ["id"] . '&delete=1">Delete</a></li></li>';
					}
					echo "</ul>";
				}
			}
		}
	}
}
if (! isset ( $_REQUEST ['notemplate'] )) {
	echo '</div>';
}
?>