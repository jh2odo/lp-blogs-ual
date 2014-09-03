<?php

class PostCommentTagSeeder extends Seeder {

	public function run()
	{
		
		$content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'.
					'Praesent vel ligula scelerisque, vehicula dui eu, fermentum velit.'.
					'Phasellus ac ornare eros, quis malesuada augue. Nunc ac nibh at mauris dapibus fermentum.'.
					'In in aliquet nisi, ut scelerisque arcu. Integer tempor, nunc ac lacinia cursus, '.
					'mauris justo volutpat elit, '.
					'eget accumsan nulla nisi ut nisi. Etiam non convallis ligula. Nulla urna augue, '.
					'dignissim ac semper in, ornare ac mauris. Duis nec felis mauris.';
		for( $i = 1 ; $i <= 20 ; $i++ )
		{
			$post = new Post;
			$post->title = "Post no $i";
			$post->summary = substr($content, 0, 120);
			$post->content = $content;
			$post->id_blogs = rand(1, 2);
			$post->save();
			
			$tag = Tag::find(rand(1, 4));
			$post->getTags()->save($tag);

			$maxComments = mt_rand(3,15);
			for( $j = 1 ; $j <= $maxComments; $j++)
			{
				$comment = new Comment;
				$comment->content = substr($content, 0, 120);
				$comment->approved = 'yes';
				$comment->id_users = 1;
				$post->getComments()->save($comment);
			}	
		}

	}

}
