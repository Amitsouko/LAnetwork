
function getUsers(id,func)
{
    $.ajax({
      method: "GET",
      url: Routing.generate('lan_tournament_api_getusers', {id:id}),
      data: {}
    })
      .done(function(result){func(result)});
}

function getTeams(id,func)
{
    $.ajax({
      method: "GET",
      url: Routing.generate('lan_tournament_api_getteams', {id:id}),
      data: {}
    })
      .done(function(result){func(result)});
}


function shuffle(array) {
  var currentIndex = array.length, temporaryValue, randomIndex ;

  // While there remain elements to shuffle...
  while (0 !== currentIndex) {

    // Pick a remaining element...
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;

    // And swap it with the current element.
    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }

  return array;
}

function getRandomString()
{
  return Math.random().toString(36).substring(7);
}