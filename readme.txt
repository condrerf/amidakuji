1.プロジェクト概要

特定のデータファイルを読み込んであみだくじを生成し、
くじの特定の縦線の位置に最終的に到達する縦線の番号を求めます。
逆に、特定の縦線の位置からくじを開始した場合に最終的に到達する縦線の番号を求めることも出来ます。


2.プロジェクト構成

index.php あみだくじの動作確認用のスクリプトです。
data/error_empty.dat 動作確認テスト用のデータファイルです。
data/error_include_character.dat 動作確認テスト用のデータファイルです。
data/error_not_3_columns.dat 動作確認テスト用のデータファイルです。
data/error_one_row.dat 動作確認テスト用のデータファイルです。
data/example1.dat 例1のあみだくじデータファイルです。
data/example2.dat 例2のあみだくじデータファイルです。
src/Amidakuji.php あみだくじを管理するクラスです。
src/Coordinate.php XY座標を管理するクラスです。
src/Field.php あみだくじのフィールドを管理するクラスです。
src/Unit.php あみだくじのユニット(あみだくじの線を移動する主体)を管理するクラスです。
src/Line/Line.php あみだくじの線(縦/横)を管理するクラスです。
src/Line/TransverseLine.php あみだくじの横線を管理するクラスです。
src/Line/VerticalLine.php あみだくじの縦線を管理するクラスです。
tests/AmidakujiTest.php Amidakujiクラスのテストクラスです。
tests/CoordinateTest.php Coordinateクラスのテストクラスです。
tests/FieldTest.php Fieldクラスのテストクラスです。
tests/LineTest.php Lineクラスのテストクラスです。
tests/TransverseLineTest.php TransverseLineクラスのテストクラスです。
tests/UnitTest.php Unitクラスのテストクラスです。
tests/VerticalLineTest.php VerticalLineクラスのテストクラスです。

以下は、PHP.Skeletonにより自動生成されたファイルです。
.php_cs
.scrutinizer.yml
.travis.yml
composer.json
composer.lock
LICENSE
phpcs.xml
phpmd.xml
phpunit.xml.dist
src/Exception/ExceptionInterface.php
src/Exception/LogicException.php
src/Exception/RuntimeException.php
tests/bootstrap.php
tests/Fake/.placefolder


3.実行方法

(1)data/ディレクトリ内に、あみだくじのデータファイルを設置する。
(2)データファイル名を指定して、Amidakujiクラスのインスタンスを生成する。
(3)最終的に到達する縦線の番号を指定して、findStartNumber関数を実行する。
(4)findStartNumber関数の戻り値を出力する。

実行例は、index.phpをご覧ください。
