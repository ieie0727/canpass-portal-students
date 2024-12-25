@extends('layouts.app')

@section('content')
<div class="container">
    {{-- タイトル --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    {{-- グラフセクション --}}
    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">学習進捗（合格数の推移）</h6>
                </div>
                <div class="card-body">
                    {{-- グラフ要素 --}}
                    <canvas id="progressChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>

        {{-- 学習概要カード --}}
        <div class="col-lg-4">
            <div class="card border-left-success shadow mb-4">
                <div class="card-body">
                    <h6 class="text-success font-weight-bold">学習済み単元数</h6>
                    <p class="h5 mb-0 font-weight-bold text-gray-800">{{ $completedSections }}</p>
                </div>
            </div>
            <div class="card border-left-warning shadow mb-4">
                <div class="card-body">
                    <h6 class="text-warning font-weight-bold">未学習単元数</h6>
                    <p class="h5 mb-0 font-weight-bold text-gray-800">{{ $remainingSections }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- 最近の学習履歴 --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">最近の学習履歴</h6>
        </div>
        <div class="card-body">
            @if($recentRecords->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-bordered text-center" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>日付</th>
                            <th>単元</th>
                            <th>スコア</th>
                            <th>結果</th>
                            <th class="text-center">詳細</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentRecords as $record)
                        <tr>
                            <td>{{ $record->updated_at->format('Y-m-d') }}</td>
                            <td>{{ $record->section->name }}</td>
                            <td>{{ $record->score }}</td>
                            <td>
                                @if($record->is_passed)
                                <span class="badge bg-success">合格</span>
                                @else
                                <span class="badge bg-danger">不合格</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('tests.record', ['section_id' => $record->section_id]) }}"
                                    class="btn btn-info btn-sm">詳細</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p class="text-center text-muted">最近の学習履歴がありません。</p>
            @endif
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        if (typeof Chart === "undefined") {
            console.error("Chart.js is not loaded");
            return;
        }

        const ctx = document.getElementById('progressChart').getContext('2d');
        const rawProgressData = @json($progressData);

        // 今日と1週間前の日付を計算
        const today = new Date();
        const oneWeekAgo = new Date();
        oneWeekAgo.setDate(today.getDate() - 6); // 今日を含む7日分

        // 日付範囲を生成
        const labels = [];
        const currentDate = new Date(oneWeekAgo);
        while (currentDate <= today) {
            labels.push(currentDate.toISOString().split('T')[0]); // "YYYY-MM-DD" 形式
            currentDate.setDate(currentDate.getDate() + 1);
        }

        // 合格数データを取得（該当データがない場合は0）
        const dailyData = labels.map(date => rawProgressData[date] || 0);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels, // 日付ラベル（1週間分）
                datasets: [{
                    label: '合格数',
                    data: dailyData, // その日の合格数データ
                    borderColor: '#4CAF50',
                    backgroundColor: 'rgba(76, 175, 80, 0.2)',
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: '日付',
                        },
                        ticks: {
                            autoSkip: false, // すべての日付を表示
                        },
                    },
                    y: {
                        title: {
                            display: true,
                            text: '合格数',
                        },
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1, // 縦軸の刻みを1に設定
                            callback: function(value) {
                                return Number(value).toFixed(0); // 小数を整数に変換
                            }
                        }
                    },
                },
            }
        });
    });
</script>
@endpush