<?php namespace Zisoft\Comments\ReportWidgets;

use Backend\Classes\ReportWidgetBase;
use Zisoft\Comments\Models\Comment;
use Illuminate\Support\Facades\DB;
use Lang;

class CommentsStatistics extends ReportWidgetBase
{
    public function defineProperties()
    {
        return [
            'maxRows' => [
                'title'             => Lang::get('zisoft.comments::lang.reportwidgets.maxrows'),
                'default'           => '10',
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$'
            ]
        ];
    }    

    public function render()
    {
        $maxrows = $this->property('maxRows') - 1;
        
        $total_comments = Comment::all()->count();
        $pending_comments = Comment::where('is_pending', true)->count();

        $data = [
            [
                Lang::get('zisoft.comments::lang.reportwidgets.total'),
                $total_comments,
                $pending_comments
            ]
        ];

        $rows = Db::table('zisoft_comments_comments')
            ->select(Db::raw('url, count(*) as comment_count, count(case when is_pending=1 then 1 else null end) as pending_count'))
            ->groupBy('url')
            ->orderBy('comment_count', 'desc')
            ->take($maxrows)
            ->get();

        foreach ($rows as $row) {
            array_push($data, [$row->url, $row->comment_count, $row->pending_count]);
        }

        return $this->makePartial('commentsstatistics', [
            'statistics' => $data
        ]);
    }

}

