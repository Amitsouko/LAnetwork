$(function()
{
    displayTeamList();

    function displayTeamList()
    {
        getTeams(_id, function(result){
            generateRandomTree(result.data);
        })
    }

    function generateRandomTree(obj)
    {
        var _nbPerFight = 2,
            nbTeams = 5,
            //nbTeams = obj.length,
            nbMaxsimRound = Math.ceil(nbTeams / _nbPerFight);

        obj = shuffle(obj);
        
        var firstRound = createRound(null, _nbPerFight);
        firstRound.rank = 1;
        recursiveCreateTree(firstRound,1,nbMaxsimRound);
        console.log(firstRound);
    }


    function recursiveCreateTree(round, rank, maxRank)
    {
        var nbPerFight = round.nbPerFight;
        var nextRank = (rank == 1) ? round.nbPerFight : rank*rank;

        for(var i = 0; i < nbPerFight ; i++)
        {
            subround = createRound(null, nbPerFight);
            subround.rank = nextRank;
            round.children[i] = subround;
            //subround.parent = round;
            if( nextRank  < maxRank    )
            {
                recursiveCreateTree(subround, nextRank,maxRank);
            }           
        }

    }

    // Handle the remaining team and create sub tree to ad them

    function createRound(participants, nbPerFight)
    {
        round = {
            "rank"      : null,
            "id"        : getRandomString(),
            "teams"     : participants,
            "parent"    : null,
            "children"  : new Array(),
            nbPerFight  : nbPerFight
        };
        return round;
    }
});