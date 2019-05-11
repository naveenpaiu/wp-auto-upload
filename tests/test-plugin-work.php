<?php


class PluginWorkTest extends WP_UnitTestCase
{
    const CONTENT = '<img src="https://irani.im/images/ali-irani.jpg" />';

    public function testCreatePost()
    {
        $postID = $this->factory->post->create(array('post_content' => self::CONTENT, 'post_name' => 'test'));

        $this->assertGreaterThan(0, $postID, 'Post creation failed.');

        $post = $this->factory->post->get_object_by_id($postID);

        $this->assertInstanceOf('WP_Post', $post, 'Get created post failed.');

        return $post;
    }

    /**
     * @depends testCreatePost
     */
    public function testPluginWorks(WP_Post $post)
    {
        $this->assertStringMatchesFormat('%shttp://example.org/wp-content/uploads/%d/%d/%s.jpg%s', $post->post_content);
    }
}
