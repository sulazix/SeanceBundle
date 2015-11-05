seanceApp.filter('range', function() {
    return function( items, rangeInfo ) {
        var filtered = [];
        var min = parseInt(rangeInfo.min);
        var max = parseInt(rangeInfo.max);
        // If time is with the range
        angular.forEach(items, function(item, key) {
            if( key >= min && key <= max ) {
                filtered.push(item);
            }
        });
        return filtered;
    };
});