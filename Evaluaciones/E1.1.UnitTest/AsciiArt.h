#include <iostream>
#include <fstream>
#include <cstdlib>
#include <stdlib.h>
#include <vector>
#include <string>
using namespace std;


class AsciiArt
{

	public:
		AsciiArt(string);// Constructor de la clase AsciiArt
		string Lectura();//metodo del lectura
		string Escribe();//metodo del escritura
		string getDataCompressed();
		protected:
			string file_name, image, result;
};
//contructor de la calse AsciiArt con el tamaño del AsciiArt

AsciiArt::AsciiArt(string filename)
{

	file_name = filename;
}

string AsciiArt::getDataCompressed(){
	return result;
}
// Se define el AsciiArt por el usuario y se define el tamaño .

string AsciiArt::Lectura(){
	char buffer[1];
	ofstream outfile ("compress.txt");
	int i = 0;//se declara la variable i y se iguala a cero 0
	fstream datos;//se instancia el archivo
	datos.open(file_name); //se abre el archivo
	int a=1;
	vector<char> v;
	vector<char> res;
	char c;
	while (datos.get(c))
	{
		v.push_back(c);
	}
	for (int i = 0; i < v.size(); i++)
	{
		if(v[i]==v[i+1])
		{
			a++;
		}
		else if(v[i]=='\n')
		{
			cout<<"\n";
			outfile<<"\n";
			result="\n";
		}
		else
		{
			outfile<<a<<v[i];
			cout<<a<<v[i];
			result=a;
			result=v[i];
			a=1;
		}

	}
	datos.close();//se cierra el archivo
	return result;

}




// imprime los valores del AsciiArt

string AsciiArt::Escribe()
{
	char buffer[1];
	int a;
	ofstream outfile ("descompress.txt");
	int i = 0;//se declara la variable i y se iguala a cero 0
	fstream datos;//se instancia el archivo
	datos.open(file_name); //se abre el archivo
	vector<char> final;
	char c;
	int z;
	while (datos.get(c))
		{
			final.push_back(c);
		}
		for (int i = 0; i < final.size(); i+=2)
		{
			if(final[i]=='\n')
			{
				i--;
				outfile<<'\n';
				cout<<'\n';
				result='\n';
			}
			//cout<<final[i];
			 z=final[i]-48;
			if(z>=1)
			{
			for (int j = 0; j < z; j++)
				{
					outfile<<final[i+1];
					cout<<final[i+1];
					result=final[i+1];
				}
			}

		}
	datos.close();
	return result;
}