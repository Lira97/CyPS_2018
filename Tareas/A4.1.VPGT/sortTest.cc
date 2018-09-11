#include "gtest/gtest.h"
#include "sort.h"


using ::testing::ValuesIn;
using ::testing::Combine;
using ::testing::Range;

template <class T>
class TypedFixture : public ::testing::TestWithParam<T>
{
public:
	void SetUp()
	{
		parent = new T;
	}
	void TearDown()
	{
		cout<<"ds";
		delete parent ;
	}
	
	T* parent;
};
typedef ::testing::Types<bubbleSort,selectionSort,insertionSort> implementations;

TYPED_TEST_CASE(TypedFixture,implementations);
int arr[] = {8,6,3,1};
int ordenado[]={1,3,6,8};
TYPED_TEST(TypedFixture,implementations)
{
	this->parent->sort(arr, 4);
if(equal(begin(arr),end(arr),begin(ordenado)))
{
	cout<< "iguanas ";
}
}


