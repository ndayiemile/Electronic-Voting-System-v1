<?php 
session_start();
$account=$_SESSION['email'];
?>
<?php include('admin_dash_engine.php')?>
<html>
    <head>
        <title>outcomes</title>
        <style>
        .left_div{
            width:400px;
            height:100%;
            margin-top:10px;
            overflow-y:auto;
            float:left;
        }
        .left_div h3{
            text-align:center;
        }
        .start_stop,.start_stop2{
            background-color:olive;
            width:100%;
            bottom:0px;
            color:white;
            padding:20px;
            font-size:20px;
            border:none;
            transition: background-color 5s;

        }
        .start_stop2:hover{
            background-color:rgb(201, 201, 22);
            cursor:pointer;
        }
        .start_stop:hover{
            background-color:pink;
            cursor:pointer;
        }
        .start_stop2{
            background-color:pink;
        }
        .left_div table{
            border-collapse:none;
            width:95%;
            margin:0 auto;
            border-style:solid;
            border-width:0px 0px 3px 0px;
            border-color:orange;
        }
        .left_div table th{
            font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            background-color:orange;
        }
        .left_div table th,td{
            text-align:left;
            padding:10px;
        }
        .left_div table tr:nth-child(even){background-color: #f2f2f2;}









        .right_div{
            background-color:wheat;
            width:919px;
            height:100%;
            margin-top:10px;
            float:left;
            overflow:auto;
            padding-left:5px;
            padding-right:5px;
        }
        .right_div h4{
            text-align:center;
            font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;

        }
        .mid_div{
            background-color:white;
            width:595px;
            margin-right:5px;
            height:570px;
            margin-bottom:5px;
            float:left;
            overflow-y:auto;
        }
        .back_div{
            background-color:#f2f2f2;
            width:300px;
            height:570px;
            float:left;
            margin-bottom:5px;
        }
        .mid_div,.back_div h3{
            text-align:center;
            color:orange;
        }
        .button button{
            width:100%;
            padding:10px;
            border:none;
            margin:1px 1px 0px 1px;
            background-color:olive;
            color:white;
            font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;

        }
        .button #subbutton,#sub_button,#s_button,#sbutton{
            display:none;
            width:48%;
            padding:10px;
            border:none;
            margin:1px 0px 1px 3px;
            background-color:rgb(201, 201, 22);
            color:white;
            font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;

        }

        .mid_div table{
            border-collapse:none;
            width:95%;
            margin:0 auto;
            margin-bottom:10px;
            border-style:solid;
            border-width:0px 0px 3px 0px;
            border-color:rgb(201, 201, 22);
        }
        #votersnotification{
            color:orangered;
            padding-top:30px;
            padding-bottom:30px;
            padding-left:10px;
            padding-right:10px;
            background-color:silver;
            margin:150px 20px 0px 20px;
        }
        .mid_div table caption{
            background-color:rgb(201, 201, 22);
            padding:5px;
            color:white;
            margin-left:2px;
            margin-right:2px;
        }
        .mid_div table input{
            border:none;
            outline:none;
            padding:0px;
            width:100%;
        }
        #topcapton{
            caption-side:top;
        }
        #bottomcaption{
            caption-side:bottom;
            background-color:orange;

        }
        .captionbutton:hover{
            color:orangered;
            cursor:pointer;
        }
        .mid_div table th{
            font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            background-color:orange;
        }
        .mid_div table th,td{
            text-align:left;
            padding:10px;
        }
        .mid_div table tr:nth-child(even){background-color: #f2f2f2;}
        #manual_ids,#edit_ids{
            display:none;
        }
        #edit_ids input,#manual_ids input{
            background-color: inherit;
            font-size:17px;
        }
        .actions{
            padding-top:20px;
            margin-top:10px;
            background-color:rgb(248, 235, 205);
            float:left;
            width:100%;
        }
        .actions table{
            border-collapse:none;
            width:95%;
            margin:0 auto;
            margin-bottom:10px;
            border-style:solid;
            border-width:0px 0px 3px 0px;
            border-color:rgb(201, 201, 22);

        }
        .actions table tr:nth-child(even){background-color: wheat;}
        .actions table th,td{
            text-align:left;
            padding:10px;
        }
        .actions table th{
            font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            background-color:orange;
        }
        .actions table caption{
            background-color:rgb(201, 201, 22);
            padding:5px;
            color:white;
            margin-left:2px;
            margin-right:2px;
        }

        </style>
    </head>
    <body>
        <?php include('header.html')?>
    <?php 
    //session management state checker
    $state_check="SELECT session_state FROM $account WHERE id=1 LIMIT 1";
    $state_in=mysqli_query($db,$state_check);
    $state_out=mysqli_fetch_assoc($state_in);
    $state=$state_out['session_state'];
      //fetch the number of voters and candidates from the database
      $candidates="SELECT n_candidates,n_voters FROM $account WHERE id=1 LIMIT 1";
      $fetch=mysqli_query($db,$candidates);
      $n=mysqli_fetch_assoc($fetch);
      $number=$n['n_candidates'];
      $totalvotes=$n['n_voters'];
    
     //fetch the number of voters from the database
     $voters="SELECT n_voters FROM $account WHERE id=1 LIMIT 1";
     $fetch_voters=mysqli_query($db,$voters);
     $nu=mysqli_fetch_assoc($fetch_voters);
     $numb=$nu['n_voters'];
     $recorded=$numb+$number;
     $_SESSION['total']=$recorded;
     //check for voting_ids availabity
     $vote_check="SELECT*FROM  $account WHERE n_voters=0";
     $vote_checking=mysqli_query($db,$vote_check);
  
    ?>
        <div class="left_div">
            <form action="admins_dash.php" method="post">
                <?php if($state=="paused"):?>
                    <button class="start_stop" type="submit" name="session_manager1">START SESSION</button>
                <?php endif ?>
                <?php if($state=="started"):?>
                    <button class="start_stop2" type="submit" name="session_manager2">END SESSION</button>
                <?php endif ?>
            </form>
            <h3>LATEST UPDATES ABOUT ELECTION</h3>
            <table>
                <tr>
                    <th>candidates</th>
                    <th>votes</th>
                    <th>%</ht>
                </tr>
                <?php
                    //openig the loop for page content
                    for($i=1;$i<=$number;$i++):
                    //fetching the data from database
                    $query="SELECT cd_name,votes FROM $account WHERE id=$i LIMIT 1";
                    $result=mysqli_query($db,$query);
                    $text=mysqli_fetch_assoc($result);
                    ?>
                    <tr>
                        <td><?php echo $text['cd_name'];?></td>
                        <td><?php echo $text['votes'];?></td>
                        <td><?php $percent=$text['votes']/$totalvotes*100; echo $percent;//for calculating the percentage?></td>
                    </tr>
                <?php endfor ?>
               
            </table>
        </div>
        <div class="right_div">
            <h4>ADMIN TOOLS FOR MANAGING THE VOTE SESSION</h4>
            <?php if($state=="paused"):?>
                <div class="mid_div">
                    <h3>VOTERS IDS</h3>
                    <?php if(mysqli_num_rows($vote_checking)==0):?>
                        <h1 id="votersnotification">PLEASE CREATE THE VOTERS IDS</h1>
                    <?php endif?>
                    <form action="admins_dash.php" method="post">
                        <table id="manual_ids">
                            <caption id="topcaption">FILL WITH MANUAL IDS</caption>
                            <tr>
                                <th>number</th>
                                <th>key</th>
                            </tr>
                            <?php
                                $_SESSION['cand']=$number;
                                $_SESSION['number_voters']=$numb;
                                //openig the loop for page content
                                for($v=1;$v<=$numb;$v++):
                            ?>
                            <tr>
                                <td><?php echo $v ?></td>
                                <td><input type="text" name="manual_input<?php echo $v ?>"/></td>
                            </tr>
                            <?php endfor ?>
                            <caption id="bottomcaption"><input type="submit" class="captionbutton" name="manual_ids_save" value="SAVE"/></caption>
                        </table>
                   </form>
                   <form action="admins_dash.php" method="post">
                        <table id="edit_ids">
                            <caption id="topcaption"> EDIT IDS</caption>
                            <tr>
                                <th>number</th>
                                <th>key</th>
                            </tr>
                            <?php
                                 for($v=$number+1;$v<=$recorded;$v++):
                                     //fetching the data from database
                            $queryv="SELECT voters_id FROM $account WHERE id=$v LIMIT 1";
                            $resultv=mysqli_query($db,$queryv);
                            $textv=mysqli_fetch_assoc($resultv);
                                    
                            ?>
                            <tr>
                                <td><?php echo $v-$number ?></td>
                                <td><input type="text" name="manual_input<?php echo $v ?>" value="<?php echo $textv['voters_id'];?>"/></td>
                            </tr>
                            <?php endfor ?>
                            <caption id="bottomcaption"><input type="submit" class="captionbutton" name="manual_ids_edit" value="EDIT"/></caption>
                        </table>
                   </form>
                </div>
                <div class="back_div">
                    <h3>MANAGE MENU</h3>
                    <?php if(mysqli_num_rows($vote_checking)==0):?>
                        <div class="button">
                            <button type="button" onclick="document.getElementById('manual_ids').style.display='table';document.getElementById('votersnotification').style.display='none'">CREATE VOTERS IDS</button>
                        </div>
                    <?php endif ?>
                    <?php if(mysqli_num_rows($vote_checking)!=0):?>
                        <div class="button">
                            <button type="button" onclick="document.getElementById('edit_ids').style.display='table'">MANAGE IDS</button>
                        </div>
                    <?php endif ?>

                </div>
            <?php endif?>
            <?php if($state=="started"):?>
                <div class="actions">
                    <table>
                        <caption>FULL VOTING DATA</caption>
                            <tr>
                                <th>num</th>
                                <th>ID</th>                   
                                <th>VOTE/DIDN'T VOTED</th>
                            </tr>
                            <?php
                                for($v=$number+1;$v<=$recorded;$v++):
                                //fetching the data from database
                                $queryv="SELECT voters_id,vote_checker FROM $account WHERE id=$v LIMIT 1";
                                $resultv=mysqli_query($db,$queryv);
                                $textv=mysqli_fetch_assoc($resultv);
                            ?>
                            <tr>
                                <td><?php echo $v-$number ?></td>
                                <td><?php echo $textv['voters_id'];?></td>
                                <td><?php echo $textv['vote_checker'];?></td>
                            </tr>

                        <?php endfor ?>
                    </table>
                </div>
            <?php endif ?>
    </div>
    <?php include('footer.html')?>
    </body>
</html>