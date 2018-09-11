#include <iostream>
using namespace std;

class Sort
{
public:
	virtual void sort(int *array,int t)=0;

};

class bubbleSort : public Sort
{
public:
	void sort(int *array,int t)
	{
		bool s = true;
		int j = 0;
		int tmp;
		while(s){
			s = false;
			j++;
			for (int i = 0; i < t - j; i++) {
				if (array[i] > array[i + 1]) {
					tmp = array[i];
					array[i] = array[i + 1];
					array[i + 1] = tmp;
					s = true;	
				}
			}
		}
		for (int i = 0; i < t-1; i++){
				if(i < t){
					cout << array[i]<<", ";
				}
			}
			cout << array[t- 1]<<". "<< endl;
	}
};
class selectionSort : public Sort
{
public:
	void sort(int *array,int t)
	{
		int posmin;
		int temp;
		for (int i = 0; i < t-1; i++){
			posmin = i;
			for(int j = i + 1; j < t; j++){
				if(array[j] < array[posmin]){
					posmin = j;
					
				}
			}
			if (posmin != i){
				temp = array[i];
				array[i] = array[posmin];
				array[posmin] = temp;
			}
		}
		for (int i = 0; i < t-1; i++){
				if(i < t){
					cout << array[i]<<", ";
				}
			}
			cout << array[t- 1]<<". "<< endl;
	}
	
};
class insertionSort : public Sort
{
public:
	void sort(int *array,int t)
	{
		int j; 
		int temp;
		for (int i = 0; i < t; i++){
			j = i;
			while (j > 0 && array[j] < array[j-1]){
				temp = array[j];
				array[j] = array[j-1];
				array[j-1] = temp;
				j--;
				  }
				
			
			}
		for (int i = 0; i < t-1; i++){
		if(i < t){
			cout << array[i]<<", ";
		}
	}
	cout << array[t- 1]<<". "<< endl;
	}	
};

