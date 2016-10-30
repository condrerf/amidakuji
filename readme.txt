1.プロジェクト概要

特定のデータファイルを読み込んであみだくじを生成し、
くじの特定の縦線の位置に最終的に到達する縦線の番号を求めます。
逆に、特定の縦線の位置からくじを開始した場合に最終的に到達する縦線の番号を求めることも出来ます。


2.プロジェクト構成

answer/index.php あみだくじの動作確認用のスクリプトです。
answer/data/error_empty.dat 動作確認テスト用のデータファイルです。
answer/data/error_include_character.dat 動作確認テスト用のデータファイルです。
answer/data/error_not_3_columns.dat 動作確認テスト用のデータファイルです。
answer/data/error_one_row.dat 動作確認テスト用のデータファイルです。
answer/data/example1.dat 例1のあみだくじデータファイルです。
answer/data/example2.dat 例2のあみだくじデータファイルです。
answer/src/Amidakuji.php あみだくじを管理するクラスです。
answer/src/Coordinate.php XY座標を管理するクラスです。
answer/src/Field.php あみだくじのフィールドを管理するクラスです。
answer/src/Unit.php あみだくじのユニット(あみだくじの線を移動する主体)を管理するクラスです。
answer/src/Line/Line.php あみだくじの線(縦/横)を管理するクラスです。
answer/src/Line/TransverseLine.php あみだくじの横線を管理するクラスです。
answer/src/Line/VerticalLine.php あみだくじの縦線を管理するクラスです。
answer/tests/AmidakujiTest.php Amidakujiクラスのテストクラスです。
answer/tests/CoordinateTest.php Coordinateクラスのテストクラスです。
answer/tests/FieldTest.php Fieldクラスのテストクラスです。
answer/tests/LineTest.php Lineクラスのテストクラスです。
answer/tests/TransverseLineTest.php TransverseLineクラスのテストクラスです。
answer/tests/UnitTest.php Unitクラスのテストクラスです。
answer/tests/VerticalLineTest.php VerticalLineクラスのテストクラスです。

以下は、PHP.Skeletonにより自動生成されたファイルです。
answer/.php_cs
answer/.scrutinizer.yml
answer/.travis.yml
answer/composer.json
answer/composer.lock
answer/LICENSE
answer/phpcs.xml
answer/phpmd.xml
answer/phpunit.xml.dist
answer/src/Exception/ExceptionInterface.php
answer/src/Exception/LogicException.php
answer/src/Exception/RuntimeException.php
answer/tests/bootstrap.php
answer/tests/Fake/.placefolder

以下は、課題に関する情報のファイルです。
README.md
questions/amida01.png
questions/amida02.png
questions/index.md


3.実行方法

(1)answer/data/ディレクトリ内に、あみだくじのデータファイルを設置する。
(2)データファイル名を指定して、Amidakujiクラスのインスタンスを生成する。
(3)最終的に到達する縦線の番号を指定して、findStartNumber関数を実行する。
(4)findStartNumber関数の戻り値を出力する。

実行例は、answer/index.phpをご覧ください。
