define([
    'jquery'
], function ($) {
    var DevDashboard = {
        initialize: function (config, element) {
            alert('it works');
        }
    };
    return {
        devDashboard: DevDashboard.initialize
    }
});