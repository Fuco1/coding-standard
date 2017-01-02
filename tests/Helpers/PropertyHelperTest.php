<?php declare(strict_types = 1);

namespace SlevomatCodingStandard\Helpers;

class PropertyHelperTest extends \SlevomatCodingStandard\Helpers\TestCase
{

	/** @var \PHP_CodeSniffer_File */
	private $testedCodeSnifferFile;

	public function dataIsProperty(): array
	{
		return [
			[
				'$boolean',
				true,
			],
			[
				'$string',
				true,
			],
			[
				'$boo',
				false,
			],
			[
				'$hoo',
				false,
			],
		];
	}

	/**
	 * @dataProvider dataIsProperty
	 * @param string $variableName
	 * @param bool $isProperty
	 */
	public function testIsProperty(string $variableName, bool $isProperty)
	{
		$codeSnifferFile = $this->getTestedCodeSnifferFile();

		$variablePointer = $codeSnifferFile->findNext(T_VARIABLE, 0, null, false, $variableName);
		$this->assertSame($isProperty, PropertyHelper::isProperty($codeSnifferFile, $variablePointer));
	}

	private function getTestedCodeSnifferFile(): \PHP_CodeSniffer_File
	{
		if ($this->testedCodeSnifferFile === null) {
			$this->testedCodeSnifferFile = $this->getCodeSnifferFile(
				__DIR__ . '/data/propertyOrNot.php'
			);
		}
		return $this->testedCodeSnifferFile;
	}

}