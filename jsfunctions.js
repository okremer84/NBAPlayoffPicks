function selectTeam(teamClicked)
{
	var id = $(teamClicked.target).attr('id');
	teamID = id.split('_')[0];
	where = id.split('_')[1];
	
	$("#" + where).children(".teamImg").attr('src', $(teamClicked.target).attr('src'));
	
	nextID = $("#" + where).children(".teamImg").attr('id')
	nextID = teamID + "_" + nextID.split('_')[1];
	$("#" + where).children(".teamImg").attr('id', nextID);
	$("input[name*='" + where + "']").attr('value', teamID);
}

function getPlayersForTeam(sel)
{
	$('[id^="MVP_"]').css('visibility', 'hidden');
	$('[id^="MVP_"]').attr('name','');
	var id = sel.value;
	$("#MVP_" + id).css('visibility', 'visible');
	$("#MVP_" + id).attr('name', 'MVP');
}

$(document).ready(function()
{
	$("li").each(function(index, element) {
        if ($(element).hasClass('team'))
		{
			if ($(element).children(".teamImg").attr('id').charAt(0) != '_')
			{
				teamID = $(element).children(".teamImg").attr('id').split('_')[0];
				var where = $(element).attr('id');
				$("input[name*='" + where + "']").attr('value', teamID);
			}
		}
    });
	if ($("#finalsWinner").children(".teamImg").attr('id').charAt(0) != '_')
	{
		teamID = $("#finalsWinner").children(".teamImg").attr('id').split('_')[0];
		var where = $("#finalsWinner").attr('id');
		$("input[name*='" + where + "']").attr('value', teamID);
	}
	
	selectedTeam = $("#teamSelector").val();
	$("#MVP_" + selectedTeam).css('visibility', 'visible');
	$("#MVP_" + selectedTeam).attr('name', 'MVP');
	
    $('form').submit(function() {
		var str = $("#picksForm").serialize();
        $.ajax({
            type: 'POST',
            url: 'sendPicks.php',
            data: str
        });
		alert("Picks sent succesfully!");
		location.reload();
        return false;
    }); 
	
	$("#SideBar").load("getFriends.php?friends=true");
});

function selectFriends()
{
	$("#SideBar").html("");
	$("#SideBar").load("getFriends.php?friends=true");
	$("#globalButton").removeClass("selectedButton");
	$("#friendsButton").removeClass("selectedButton");
	$("#friendsButton").addClass("selectedButton");
}

function selectGlobal()
{
	$("#SideBar").html("");
	$("#SideBar").load("getFriends.php?friends=false");
	$("#friendsButton").removeClass("selectedButton");
	$("#globalButton").removeClass("selectedButton");
	$("#globalButton").addClass("selectedButton");
}

