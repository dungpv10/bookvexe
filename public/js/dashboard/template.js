var loadTrTemplate = function(event){
    var matchAwayScore = event.match_awayteam_score !== "" ? event.match_awayteam_score : 0;
    var matchHomeScore = event.match_hometeam_score !== "" ? event.match_hometeam_score : 0;
    return '<tr class="match-id-' + event.match_id + '">\n' +
        '                                                <td class="f-500 c-cyan text-center">\n' +
        '                                                    ' + matchHomeScore + '-' + matchAwayScore + ' <br/>\n' +
        '                                                    ' + event.match_time + '\'\n' +
        '                                                </td>\n' +
        '                                                <td class="f-500 c-cyan">\n' +
        '                                                    <div class="row">\n' +
        '                                                        <div class="col-md-7">\n' +
        '                                                            ' + event.match_hometeam_name + '<br/>\n' +
        '                                                            <span class="text-danger">' + event.match_awayteam_name + '</span><br/>\n' +
        '                                                            <span style="color: #777">Hoà</span>\n' +
        '                                                        </div>\n' +
        '                                                        <div class="col-md-5 text-right" style="padding: 15% 5px 15% 0">\n' +
        '                                                        <span style="border-radius: 20%;width: 10px;height: 10px;;padding: 3px 3px 3px 5px;background: #5574a7"><i\n' +
        '                                                                    style="color: #fff;"\n' +
        '                                                                    class="fa fa-dollar"></i>&nbsp;</span>\n' +
        '\n' +
        '                                                            <span style="border-radius: 20%;width: 10px;height: 10px;;padding: 3px 3px 3px 5px;background: #5574a7"><i\n' +
        '                                                                        style="color: #fff;"\n' +
        '                                                                        class="fa fa-wifi"></i>&nbsp;</span>\n' +
        '                                                        </div>\n' +
        '                                                    </div>\n' +
        '\n' +
        '                                                </td>\n' +
        '                                                <td class="f-500 c-cyan">\n' +
        '                                                    <div class="row">\n' +
        '                                                        <div class="col-md-2" style=";">\n' +
        '                                                            0\n' +
        '                                                        </div>\n' +
        '                                                        <div class="col-md-9 text-right">\n' +
        '                                                            -0.88 &nbsp;&nbsp;&nbsp;3-3.5<br/>\n' +
        '                                                            0.77\n' +
        '                                                        </div>\n' +
        '                                                    </div>\n' +
        '                                                </td>\n' +
        '\n' +
        '                                                <td class="f-500 c-cyan">\n' +
        '                                                    <div class="row">\n' +
        '                                                        <div class="col-md-2" style=";">\n' +
        '                                                            0\n' +
        '                                                        </div>\n' +
        '                                                        <div class="col-md-9 text-right">\n' +
        '                                                            -0.88 &nbsp;&nbsp;&nbsp;3-3.5<br/>\n' +
        '                                                            0.77\n' +
        '                                                        </div>\n' +
        '                                                    </div>\n' +
        '                                                </td>\n' +
        '\n' +
        '                                                <td class="f-500 c-cyan">\n' +
        '                                                    <div class="row">\n' +
        '                                                        <div class="col-md-2" style=";">\n' +
        '                                                            0\n' +
        '                                                        </div>\n' +
        '                                                        <div class="col-md-9 text-right">\n' +
        '                                                            -0.88 &nbsp;&nbsp;&nbsp;3-3.5<br/>\n' +
        '                                                            0.77\n' +
        '                                                        </div>\n' +
        '                                                    </div>\n' +
        '                                                </td>\n' +
        '\n' +
        '                                                <td class="f-500 c-cyan">\n' +
        '                                                    <div class="row">\n' +
        '                                                        <div class="col-md-2" style=";">\n' +
        '                                                            0\n' +
        '                                                        </div>\n' +
        '                                                        <div class="col-md-9 text-right">\n' +
        '                                                            -0.88 &nbsp;&nbsp;&nbsp;3-3.5<br/>\n' +
        '                                                            0.77\n' +
        '                                                        </div>\n' +
        '                                                    </div>\n' +
        '                                                </td>\n' +
        '\n' +
        '                                                <td class="f-500 c-cyan">\n' +
        '                                                    <div class="row">\n' +
        '                                                        <div class="col-md-2" style=";">\n' +
        '                                                            0\n' +
        '                                                        </div>\n' +
        '                                                        <div class="col-md-9 text-right">\n' +
        '                                                            -0.88 &nbsp;&nbsp;&nbsp;3-3.5<br/>\n' +
        '                                                            0.77\n' +
        '                                                        </div>\n' +
        '                                                    </div>\n' +
        '                                                </td>\n' +
        '                                            </tr>';
}
