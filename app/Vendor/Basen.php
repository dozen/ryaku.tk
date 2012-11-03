<?php

/**
 * Description of Basen
 *
 * @author dozen
 */
class Basen {
    
    static private $char, $base;

    /**
     * 変換する際に使用する文字を入れたファイルを選択
     * @param string $file
     */
    function setCharFile($file = 'char') {
        self::$char = rtrim(file_get_contents($file));
        $charset = mb_detect_encoding(self::$char);
        self::$base = mb_strlen(self::$char, $charset);
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
        $place = floor(log($value, $base)); //桁数を求める(実際の桁数-1)
        while ($place >= 0) {
            $pow = pow($base, $place);
            $currentplace = floor($value / $pow); //現在の桁の数
            $result .= mb_substr(self::$char, $currentplace, 1); //文字に変換
            $value -= $currentplace * $pow; //現在の桁の分だけ引き算
            $place--;
        }
        return $result;
    }

    /**
     * 10進数にデコード
     * @param string $value
     * @param int $base
     * @return int
     */
    function decode($value, $base = false) {
        if ($base === false) {
            $base = self::$base;
        }
        $result = 0;
        $currentplace = 0;
        $place = mb_strlen($value) - 1; //桁数を求める
        while ($place >= $currentplace) {
            $pow = pow($base, $place - $currentplace);
            $currentplacechar = mb_substr($value, $currentplace, 1); //現在の桁の文字を抽出
            $result += mb_strpos(self::$char, $currentplacechar) * $pow;
            $currentplace++;
        }
        return $result;
    }

}

?>
