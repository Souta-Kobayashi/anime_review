<?php

if (! function_exists('format_broadcast_date_for_database')) {
    /**
     * broadcast_dataを保存用の形式に変換
     *
     * @param  array  $data broadcast_dateを含む配列
     * @return array 変換したbroadcast_dateを含む引数で受け取った配列
     */
    function format_broadcast_date_for_database(array $data): array
    {
        if (array_key_exists('broadcast_date', $data)) {
            // 空配列はここで削除される
            // eg) 2023, | ,春アニメ
            $broadcast_data_array = array_filter(
                explode(',', $data['broadcast_date'])
            );
            $broadcast_data = implode(' ', $broadcast_data_array);
            $data['broadcast_date'] = $broadcast_data;
        }

        return $data;
    }
}
