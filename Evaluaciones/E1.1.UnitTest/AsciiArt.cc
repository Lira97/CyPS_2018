#include "gtest/gtest.h"
#include <iostream>
#include "AsciiArt.h"

using namespace std;

// Clase Parametrizada
class AsciiArtParam1: public ::testing::TestWithParam<string>{
	public:
		// Función Set-Up
		virtual void SetUp() { 
			cout << "---- SetUp ----" << endl;
			
		}
		// Función Tear-Down
		virtual void TearDown() { 
			cout << "----- TearDown ----" << endl;
		}
};
class AsciiArtParam2: public ::testing::TestWithParam<string>{
	public:
		// Función Set-Up
		virtual void SetUp() { 
			cout << "---- SetUp ----" << endl;
			
		}
		// Función Tear-Down
		virtual void TearDown() { 
			cout << "----- TearDown ----" << endl;
		}
};


TEST_P(AsciiArtParam1, prueba_cifrado){
	string file = GetParam();
	AsciiArt ascii(file.c_str());
	string compress = ascii.Lectura();
	string compressed = ascii.getDataCompressed();
	EXPECT_EQ(compress, compressed);
}


TEST_P(AsciiArtParam2, prueba_descifrado){
	string file = GetParam();
	AsciiArt ascii(file.c_str());
	string decompress = ascii.Escribe();
	string decompressed = ascii.getDataCompressed();
	ASSERT_EQ(decompress, decompressed);
}

// Nombre de las imágenes .art a leer por cada test parametrizado
INSTANTIATE_TEST_CASE_P(archivos, AsciiArtParam1, ::testing::Values("descompress.txt"));
INSTANTIATE_TEST_CASE_P(archivos, AsciiArtParam2, ::testing::Values("compress.txt"));

