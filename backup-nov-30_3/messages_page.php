<?php
    require('./z_session.php');

    require('./control/h_new_message.php');

    require('./control/h_get_all_users.php');

    require('./control/h_get_all_conversations.php');

    require('./html_header.php');
?>

<div class="d-flex">
    <!-- Sidebar -->
    <nav class="flex-column justify-content-start navbar navbar-dark bg-dark sidebar" style="width:350px;">
      <div class="p-2 navbar-brand"><a href="/home_page.php">Go Home</a></div>
      <div class="p-2 navbar-brand">My Conversations</div>
      <?
        for($x = 0; $x < count($h_get_all_conversations__conversations); $x++){
            $changeConversationUserID = $h_get_all_conversations__conversations[$x]["UserID"];
            $changeConversation = $h_get_all_users__users[$changeConversationUserID];
            $changeConversationName = $changeConversation["FName"]." ".$changeConversation["LName"];
            print("
                <div>
                    <a href='?conversationUserID={$changeConversationUserID}'>{$changeConversationName}</a>
                </div>
            ");
        }
      ?>
    </nav>
    
    <!-- Page content -->
    <div class="mainbar">
        <?php 
            $conversationUserID = $_GET['conversationUserID'];
            if(!isset($_GET['conversationUserID'])){
                ?> <h2 class='select-conversation-message'>Select a conversation</h2> <?
            }
            else{
                ?>
                <!-- Conversation Info container -->
                <?
                
                require('./control/h_get_all_users.php');
                $conversationPerson = $h_get_all_users__users[$conversationUserID];
                $conversationHeader = $conversationPerson["FName"]." ".$conversationPerson["LName"];?>
                <div class="conversation-info-container">
                    <span class="conversation-info-header"><?=$conversationHeader?></span>
                </div>
                
                <!-- Messages container -->
                <div id='messages-container' class='messages-container'><?
                $h_get_messages_for_conversation__conversationUserID = $conversationUserID;
                require('./control/h_get_messages_for_conversation.php');

                for($x = 0; $x < count($h_get_messages_for_conversation__messages); $x++){
                    $message_component__message = $h_get_messages_for_conversation__messages[$x];
                    require('./components/message_component.php');
                }
                ?></div>

                <form method='POST' action=''>
                    <div class="send-message-box">
                        <input type='hidden' name='conversationUserID' value='<?= $conversationUserID ?>'>
                        <div class='message-input'>
                            <input id='message-input' type='text' name='newMessage' class='form-control' placeholder='Enter your message here...'></input>
                        </div>
                        <div class='send-message-button'>
                            <button type='submit' class='btn btn-primary'>Send</button>
                        </div>
                    </div>
                </form>

                <script>
                    //scroll to bottom
                    var element = document.getElementById("messages-container");
                    element.scrollTop = element.scrollHeight;
                </script>
                <?
            }
        ?>


    </div>


</div>


