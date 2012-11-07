<?php

/**
 * Description of Basen
 *
 * @author dozen
 */
class Basen {

    static $char, $base;

    /**
     * 変換する際に使用する文字を入れたファイルを選択
     * @param string $file
     */
    function setCharFile($file = 'char') {
        self::$char = file_get_contents(__DIR__ . '/' . $file);
        $charset = mb_detect_encoding(self::$char);
        self::$base = mb_strlen(self::$char, $charset) - 1;
        mb_internal_encoding($charset);
    }

    /**
     * 任意の基数にエンコード
     * @param int $value
     * @param int $base
     * @return string 変換後の文字列
     */
    function encode($value, $base = false) {
        if ($base === false) {
            $base = self::$base;
        }
        $result = null;
        //$place = $base進数に変換した時の$valueの桁数
        //二桁以上になりそうなとき
        $place = floor(log($value, $base)); //桁数を求める(実際の桁数-1)
        while ($place > 0) {
            $pow = pow($base, $place);
            $currentplace = floor($value / $pow); //現在の桁の数
            $result .= mb_substr(self::$char, $currentplace - 1, 1); //文字に変換
            $value -= $currentplace * $pow; //現在の桁の分だけ引き算
            $place--;
        }

        //値が0の時はlogがうまく動かないのでここで処理する。
        //加えて、logは遅いので1桁の時はここで処理しちゃって終わりにする。
        if ($value < $base) {
            $result .= mb_substr(self::$char, $value, 1);
        }
        return $result;
    }

}

?>
