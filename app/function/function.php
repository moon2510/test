<?php 
function percent($total_marks, $scored){
	$total_marks = (($total_marks * 0.01) > 0) ? ($total_marks * 0.01) : 1;
	return round($scored / ($total_marks));
}
function get_timeago( $ptime )
{
    $etime = time() - strtotime ($ptime);
    if( $etime < 60 )
    {
        return 'less than '.$etime.' second ago';
    }
    $a = array( 12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60             =>  'hour',
                60                  =>  'minute',
                1                   =>  'second'
    );
    foreach( $a as $secs => $str )
    {
        $d = $etime / $secs;

        if( $d >= 1 )
        {
            $r = round( $d );
            return 'about ' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
        }
    }
}
?>