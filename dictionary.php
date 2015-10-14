<!DOCTYPE html>
<html>
<head>
    <title>Dictionary</title>
    <meta charset="utf-8" />
    <link href="dictionary.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="header">
    <h1>My Dictionary</h1>
<!-- Ex. 1: File of Dictionary -->
    <?php
        $filename="dictionary.tsv";
        $lines=file_get_contents("dictionary.tsv");
        $file_explode=explode("\n", $lines);
        $word_num=0;
        foreach ($file_explode as $val) {
            $word_num++;
        }
        $file_size=filesize("dictionary.tsv");
    ?>
    <p>
        My dictionary has <?=$word_num?> total words
        and
        size of <?=$file_size?> bytes.
    </p>
</div>
<div class="article">
    <div class="section">
        <h2>Today's words</h2>
<!-- Ex. 2: Today’s Words & Ex 6: Query Parameters -->
        <?php
            function getWordsByNumber($listOfWords, $numberOfWords){
                $resultArray = array();
                $i=0;
                foreach($listOfWords as $val){
                    if($i<$numberOfWords){
                        $num=rand(1,6);
                        $resultArray[$i]=$listOfWords[$num];
                        $i++;
                    }
                }
                return $resultArray;
            }
        ?>
        <ol>
            <?php 
                $result=getWordsByNumber($file_explode,3);
                foreach ($result as $val) {
                    $array=explode("\t", $val);
                ?>
               <li><?=$array[0]?> - <?=$array[1]?></li>         
            <?php } ?>            
        </ol>
    </div>
    <div class="section">
        <h2>Searching Words</h2>
<!-- Ex. 3: Searching Words & Ex 6: Query Parameters -->
        <p>
            Words that started by <strong>'C'</strong> are followings :
        </p>

        <?php
            function getWordsByCharacter($listOfWords, $startCharacter){
                $resultArray = array();
                $num=0;
                foreach ($listOfWords as $val) {
                    $string=substr($val,0,1);
                        if($string==$startCharacter){
                        $resultArray[$num]=$val;
                        $num++;

                    }
                }
                return $resultArray;
            }?>
        <ol>            
            <?php $searchedWords=getWordsByCharacter($file_explode,'C');
            foreach ($searchedWords as $val) {
                $string = explode("\t", $val);
                ?>
                <li> <?=$string[0]?> - <?=$string[1]?> </li>
            <?php } ?>
          </ol>
    </div>
    <div class="section">
        <h2>List of Words</h2>
<!-- Ex. 4: List of Words & Ex 6: Query Parameters -->
        <?php
            function getWordsByOrder($listOfWords, $orderby){
                $resultArray = $listOfWords;
                if($orderby==0){
                    sort($resultArray);
                }elseif ($orderby==1) {
                    rsort($resultArray);
                }
                return $resultArray;
            }
        ?>
        <p>
            All of words ordered by <strong>alphabetical order</strong> are followings :
        </p>
        <ol>
        <?php
            $result = getWordsByOrder($file_explode,1);
            foreach ($result as $val) {
                $string = explode("\t", $val);
                $string2 = explode("\t", $val);
                if(strlen($string[0])>6){?>
                    <li class="long"><?=$string2[0]?> - <?=$string2[1]?></li> 
        
        <?php }else{?>
                    <li><?=$string2[0]?> - <?=$string2[1]?></li> 
        <?php }     
            } ?>
        </ol>
    </div>
    <div class="section">
        <h2>Adding Words</h2>
<!-- Ex. 5: Adding Words & Ex 6: Query Parameters -->
        <?php
            $newWord="";
            $meaning="";
            if(empty($newWord) || empty($meaning)){?>
              <p>Input word or meaning of the word doesn't exist.</p>  
        <?php }else{
            $string="\n".$newWord."  ".$meaning;
            file_put_contents("dictionary.tsv", $string,FILE_APPEND |  LOCK_EX);?>
            <p>Adding a word is success!</p>
        <?php }
        ?>
    </div>
</div>
<div id="footer">
    <a href="http://validator.w3.org/check/referer">
        <img src="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/images/w3c-html.png" alt="Valid HTML5" />
    </a>
    <a href="http://jigsaw.w3.org/css-validator/check/referer">
        <img src="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/images/w3c-css.png" alt="Valid CSS" />
    </a>
</div>
</body>
</html>
