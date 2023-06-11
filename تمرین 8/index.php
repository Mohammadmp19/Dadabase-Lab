<?php
    $post_id = 1;

    $conn = mysqli_connect("localhost", "root", "", "comments");

    if (isset($_POST["post_comment"]))
    {
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $comment = mysqli_real_escape_string($conn, $_POST["comment"]);
        $post_id = mysqli_real_escape_string($conn, $_POST["post_id"]);
        $reply_of = 0;

        mysqli_query($conn, "INSERT INTO comments(name, email, comment, post_id, created_at, reply_of) VALUES ('" . $name . "', '" . $email . "', '" . $comment . "', '" . $post_id . "', NOW(), '" . $reply_of . "')");
        echo "<p>Comment has been posted.</p>";
    }

    if (isset($_POST["do_reply"]))
    {
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $comment = mysqli_real_escape_string($conn, $_POST["comment"]);
        $post_id = mysqli_real_escape_string($conn, $_POST["post_id"]);
        $reply_of = mysqli_real_escape_string($conn, $_POST["reply_of"]);

        $result = mysqli_query($conn, "SELECT * FROM comments WHERE id = " . $reply_of);
        if (mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_object($result);

            $headers = 'From: YourWebsite <no-reply@yourwebsite.com>' . "\r\n";
            $headers .= 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            
            $subject = "Reply on your comment";

            $body = "<h1>Reply from:</h1>";
            $body .= "<p>Name: " . $name . "</p>";
            $body .= "<p>Email: " . $email . "</p>";
            $body .= "<p>Reply: " . $comment . "</p>";

            // mail($row->email, $subject, $body, $headers);
        }

        mysqli_query($conn, "INSERT INTO comments(name, email, comment, post_id, created_at, reply_of) VALUES ('" . $name . "', '" . $email . "', '" . $comment . "', '" . $post_id . "', NOW(), '" . $reply_of . "')");
        echo "<p>Reply has been posted.</p>";
    }

    $result = mysqli_query($conn, "SELECT * FROM comments WHERE post_id = " . $post_id);

    $comments = array();
    while ($row = mysqli_fetch_object($result))
    {
        array_push($comments, $row);
    }

    foreach ($comments as $comment_key => $comment)
    {
        $replies = array();

        if ($comment->reply_of == 0)
        {
            foreach ($comments as $reply_key => $reply)
            {
                if ($reply->reply_of == $comment->id)
                {
                    array_push($replies, $reply);

                    unset($comments[$reply_key]);
                }
            }
        }

        $comment->replies = $replies;
    }
?>

<form action="index.php" method="post">

    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>" required>

    <p>
        <label>Your name</label>
        <input type="text" name="name" required>
    </p>

    <p>
        <label>Your email address</label>
        <input type="email" name="email" required>
    </p>

    <p>
        <label>Comment</label>
        <textarea name="comment" required></textarea>
    </p>

    <p>
        <input type="submit" value="Add Comment" name="post_comment">
    </p>
</form>

<ul class="comments">
    <?php foreach ($comments as $comment): ?>
        <li>
            <p>
                <?php echo $comment->name; ?>
            </p>

            <p>
                <?php echo $comment->comment; ?>
            </p>

            <p>
                <?php echo date("F d, Y h:i a", strtotime($comment->created_at)); ?>
            </p>

            <ul class="comments reply">
                <?php foreach ($comment->replies as $reply): ?>
                    <li>
                        <p>
                            <?php echo $reply->name; ?>
                        </p>

                        <p>
                            <?php echo $reply->comment; ?>
                        </p>

                        <p>
                            <?php echo date("F d, Y h:i a", strtotime($reply->created_at)); ?>
                        </p>

                        <div onclick="showReplyForReplyForm(this);" data-name="<?php echo $reply->name; ?>" data-id="<?php echo $comment->id; ?>"> Reply</div>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div data-id="<?php echo $comment->id; ?>" onclick="showReplyForm(this);">Reply</div>

            <form action="index.php" method="post" id="form-<?php echo $comment->id; ?>" style="display: none;">
                
                <input type="hidden" name="reply_of" value="<?php echo $comment->id; ?>" required>
                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>" required>

                <p>
                    <label>Your name</label>
                    <input type="text" name="name" required>
                </p>

                <p>
                    <label>Your email address</label>
                    <input type="email" name="email" required>
                </p>

                <p>
                    <label>Comment</label>
                    <textarea name="comment" required></textarea>
                </p>

                <p>
                    <input type="submit" value="Reply" name="do_reply">
                </p>
            </form>
        </li>
    <?php endforeach; ?>
</ul>

<script>

function showReplyForm(self) {
    var commentId = self.getAttribute("data-id");
    if (document.getElementById("form-" + commentId).style.display == "") {
        document.getElementById("form-" + commentId).style.display = "none";
    } else {
        document.getElementById("form-" + commentId).style.display = "";
    }
}

function showReplyForReplyForm(self) {
    var commentId = self.getAttribute("data-id");
    var name = self.getAttribute("data-name");

    if (document.getElementById("form-" + commentId).style.display == "") {
        document.getElementById("form-" + commentId).style.display = "none";
    } else {
        document.getElementById("form-" + commentId).style.display = "";
    }

    document.querySelector("#form-" + commentId + " textarea[name=comment]").value = "@" + name;
    document.getElementById("form-" + commentId).scrollIntoView();
}

</script>