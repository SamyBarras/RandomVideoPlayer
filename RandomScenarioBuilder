/*
  ----- Random scenario builder -----
  v 0.1 (WIP)
  
    The idea is to build randomly a scenario (playlist of videos) according to some rules. One intro, but how much "obstacles"    (péripéties) and resolvings before arriving to the end.
    > needs external library with medias of different type (intro, obstacles, resolutions, etc) into corresponding subfolders
    > for now everything is hardcoded but should not be complicated to make it dynamic
  
*/
var rules = [2,3,4,3]; //[elements_declencheurs, obstacles, reactions, conclusions]
var num_obstacles = 1;
var hardbuild = true;
var medias_path = "medias/";
// functions
function pickItems(myArray, val) 
{
    // to randomize media used
    var pickedItem = val;
    do {
        // will choose a int between 0 and myArray
        pickedItem = Math.floor(Math.random()*(myArray));
    }
    while (pickedItem == val);
    return pickedItem;
}

function build_playlist() {
    if (hardbuild == true) {
        //hard build of playlist 
        test = new Array();
        test[0] = [medias_path, "intro"].join("/");
        test[1] = [medias_path+"perturb", "elperturb_"+pickItems(rules[1],0)].join("/");
        for (var i=1; i <= num_obstacles; i++){
            test.splice(test.length, 0, [medias_path+"obstacles", "obs_"+pickItems(rules[1], test[2])].join("/"));
            test.splice(test.length, 0, [medias_path+"resolutions", "res_"+pickItems(rules[2], test[3])].join("/"));
        }
       test[test.length] = [medias_path, "conclusion_"+ pickItems(rules[3],0)].join("/");
       return test;
    }
    else {
        //dynamic build of playlist
        alert("dynamic buid of playlist");
    }
}
// refill the array to have enough obstacles/resolutions
yolo = build_playlist();

// 
print(yolo);
