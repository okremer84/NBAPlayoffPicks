<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>NBA Playoff Picks Challenge</title>
    <link href="stylesheet.css" rel="stylesheet" type="text/css">
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="jsfunctions.js"></script>
</head>

<body>
<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=905765522820088";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<div class="SideBar" id="SideBar">

</div>
<div class="whiteBG">
    <a href="#" onClick="selectFriends(); return false;" class="smallButton friends selectedButton" id="friendsButton">Friends</a>
    <a href="#" onClick="selectGlobal(); return false;" class="smallButton global" id="globalButton">Global</a>
</div>
// TODO: Change to AJAX calls
<form action="sendPicks.php" method="post" id="picksForm">
    <div class="bracket">
        <div class="fb-share-button" data-href="http://www.nbaplayoffpicks.com/index.php?friendid={{ uid }}"
             data-layout="button_count"></div>
        <img src="images/background.png"/>
        <div class="welcomeUser">
            <img src="{{ user_pic }}" style="height:75px; width:75px"><span
                    class="welcomeText">{{ user_name }}'s Bracket</span>
        </div>
        <ul class="westQuarterFinals">
            <a href="#" onclick="selectTeam(event); return false;">
                <li class="team one"><img src="images/gs.png" class="teamImg" id="6_westSemi1"></li>
            </a>
            <a href="#" onclick="selectTeam(event); return false;">
                <li class="team two"><img src="images/hou.png" class="teamImg" id="17_westSemi3"></li>
            </a>
            <a href="#" onclick="selectTeam(event); return false;">
                <li class="team three"><img src="images/lac.png" class="teamImg" id="7_westSemi4"></li>
            </a>
            <a href="#" onclick="selectTeam(event); return false;">
                <li class="team four"><img src="images/por.png" class="teamImg" id="29_westSemi2"></li>
            </a>
            <a href="#" onclick="selectTeam(event); return false;">
                <li class="team five"><img src="images/mem.png" class="teamImg" id="18_westSemi2"></li>
            </a>
            <a href="#" onclick="selectTeam(event); return false;">
                <li class="team six"><img src="images/sa.png" class="teamImg" id="20_westSemi4"></li>
            </a>
            <a href="#" onclick="selectTeam(event); return false;">
                <li class="team seven"><img src="images/dal.png" class="teamImg" id="16_westSemi3"></li>
            </a>
            <a href="#" onclick="selectTeam(event); return false;">
                <li class="team eight"><img src="images/no.png" class="teamImg" id="19_westSemi1"></li>
            </a>
        </ul>
        <ul class="eastQuarterFinals">
            <a href="#" onclick="selectTeam(event); return false;">
                <li class="team one"><img src="images/atl.png" class="teamImg" id="21_eastSemi1"></li>
            </a>
            <a href="#" onclick="selectTeam(event); return false">
                <li class="team two"><img src="images/cle.png" class="teamImg" id="12_eastSemi3"></li>
            </a>
            <a href="#" onclick="selectTeam(event); return false;">
                <li class="team three"><img src="images/chi.png" class="teamImg" id="11_eastSemi4"></li>
            </a>
            <a href="#" onclick="selectTeam(event); return false;">
                <li class="team four"><img src="images/tor.png" class="teamImg" id="5_eastSemi2"></li>
            </a>
            <a href="#" onclick="selectTeam(event); return false;">
                <li class="team five"><img src="images/wsh.png" class="teamImg" id="25_eastSemi2"></li>
            </a>
            <a href="#" onclick="selectTeam(event); return false;">
                <li class="team six"><img src="images/mil.png" class="teamImg" id="15_eastSemi4"></li>
            </a>
            <a href="#" onclick="selectTeam(event); return false;">
                <li class="team seven"><img src="images/bos.png" class="teamImg" id="1_eastSemi3"></li>
            </a>
            <a href="#" onClick="selectTeam(event); return false;">
                <li class="team eight"><img src="images/bkn.png" class="teamImg" id="2_eastSemi1"></li>
            </a>
        </ul>
        <ul class="eastSemiFinals">
            <a href="#" onClick=selectTeam(event)>
                <li class="team semione" id="eastSemi1"><?php populateTeam("eastSemi1", "eastFinals1", $UID) ?></li>
            </a>
            <a href="#" onClick=selectTeam(event)>
                <li class="team semitwo" id="eastSemi2"><?php populateTeam("eastSemi2", "eastFinals1", $UID) ?></li>
            </a>
            <a href="#" onClick=selectTeam(event)>
                <li class="team semithree" id="eastSemi3"><?php populateTeam("eastSemi3", "eastFinals2", $UID) ?></li>
            </a>
            <a href="#" onClick=selectTeam(event)>
                <li class="team semifour" id="eastSemi4"><?php populateTeam("eastSemi4", "eastFinals2", $UID) ?></li>
            </a>
        </ul>
        <ul class="westSemiFinals">
            <a href="#" onClick=selectTeam(event)>
                <li class="team semione" id="westSemi1"><?php populateTeam("westSemi1", "westFinals1", $UID) ?></li>
            </a>
            <a href="#" onClick=selectTeam(event)>
                <li class="team semitwo" id="westSemi2"><?php populateTeam("westSemi2", "westFinals1", $UID) ?></li>
            </a>
            <a href="#" onClick=selectTeam(event)>
                <li class="team semithree" id="westSemi3"><?php populateTeam("westSemi3", "westFinals2", $UID) ?></li>
            </a>
            <a href="#" onClick=selectTeam(event)>
                <li class="team semifour" id="westSemi4"><?php populateTeam("westSemi4", "westFinals2", $UID) ?></li>
            </a>
        </ul>
        <ul class="eastFinals">
            <a href="#" onClick=selectTeam(event)>
                <li class="team finalsone"
                    id="eastFinals1"><?php populateTeam("eastFinals1", "nbaFinals2", $UID) ?></li>
            </a>
            <a href="#" onClick=selectTeam(event)>
                <li class="team finalstwo"
                    id="eastFinals2"><?php populateTeam("eastFinals2", "nbaFinals2", $UID) ?></li>
            </a>
        </ul>
        <ul class="westFinals">
            <a href="#" onClick=selectTeam(event)>
                <li class="team finalsone"
                    id="westFinals1"><?php populateTeam("westFinals1", "nbaFinals1", $UID) ?></li>
            </a>
            <a href="#" onClick=selectTeam(event)>
                <li class="team finalstwo"
                    id="westFinals2"><?php populateTeam("westFinals2", "nbaFinals1", $UID) ?></li>
            </a>
        </ul>
        <ul class="nbaFinals">
            <a href="#" onClick=selectTeam(event)>
                <li class="team nbafinalsone"
                    id="nbaFinals1"><?php populateTeam("nbaFinals1", "finalsWinner", $UID) ?></li>
            </a>
            <a href="#" onClick=selectTeam(event)>
                <li class="team nbafinalstwo east"
                    id="nbaFinals2"><?php populateTeam("nbaFinals2", "finalsWinner", $UID) ?></li>
            </a>
        </ul>
        <div class="finalsWinner" id="finalsWinner"><?php populateTeam("finalsWinner", "winner", $UID) ?></div>
        <ul class="westQuarterFinalsCount">
            <li class="quarter1"><?php populateSelect("westSemi1_count", $UID); ?>
            </li>
            <li class="quarter2"><?php populateSelect("westSemi2_count", $UID); ?>
            </li>
            <li class="quarter3"><?php populateSelect("westSemi3_count", $UID); ?>
            </li>
            <li class="quarter4"><?php populateSelect("westSemi4_count", $UID); ?>
            </li>
        </ul>
        <ul class="eastQuarterFinalsCount">
            <li class="quarter1"><?php populateSelect("eastSemi1_count", $UID); ?>
            </li>
            <li class="quarter2"><?php populateSelect("eastSemi2_count", $UID); ?>
            </li>
            <li class="quarter3"><?php populateSelect("eastSemi3_count", $UID); ?>
            </li>
            <li class="quarter4"><?php populateSelect("eastSemi4_count", $UID); ?>
            </li>
        </ul>
        <ul class="westSemiFinalsCount">
            <li class="semi1"><?php populateSelect("westFinals1_count", $UID); ?>
            </li>
            <li class="semi2"><?php populateSelect("westFinals2_count", $UID); ?>
            </li>
        </ul>
        <ul class="eastSemiFinalsCount">
            <li class="semi1"><?php populateSelect("eastFinals1_count", $UID); ?>
            </li>
            <li class="semi2"><?php populateSelect("eastFinals2_count", $UID); ?>
            </li>
        </ul>
        <ul class="confFinalsWinnersCount">
            <li class="eastFinalsWinnersCount"><?php populateSelect("eastFinalsWinner_count", $UID); ?>
            </li>
            <li class="westFinalsWinnersCount"><?php populateSelect("westFinalsWinner_count", $UID); ?>
            </li>
        </ul>
        <ul class="nbaFinalsCount">
            <li><?php populateSelect("nbaFinals_count", $UID); ?>
            </li>
        </ul>
        <div class="fb-comments" data-href="http://www.nbaplayoffpicks.com/index.php?friendid={{ uid }}"
             data-numposts="5" data-colorscheme="light"></div>
        <div class="mvpDiv">
            <ul>
                <li><img src="images/Finals MVP.png" width="140" height="17" alt=""/></li>
                <li><select onChange="getPlayersForTeam(this)" id="teamSelector" class="teamSelect">
                        <?php populateTeams($UID); ?>
                    </select>
                    <?php populatePlayers($UID); ?>
                </li>
                <li>
                </li>
            </ul>
        </div>
        <?php
        if ($sendinput == true) {
            ?>
        <input type="hidden" value="" name="eastSemi1"/>
        <input type="hidden" value="" name="eastSemi2"/>
        <input type="hidden" value="" name="eastSemi3"/>
        <input type="hidden" value="" name="eastSemi4"/>
        <input type="hidden" value="" name="westSemi1"/>
        <input type="hidden" value="" name="westSemi2"/>
        <input type="hidden" value="" name="westSemi3"/>
        <input type="hidden" value="" name="westSemi4"/>
        <input type="hidden" value="" name="eastFinals1"/>
        <input type="hidden" value="" name="eastFinals2"/>
        <input type="hidden" value="" name="westFinals1"/>
        <input type="hidden" value="" name="westFinals2"/>
        <input type="hidden" value="" name="nbaFinals1"/>
        <? } ?>
</form>
</div>
</body>
</html>