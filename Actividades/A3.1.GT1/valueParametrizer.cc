#include "gtest/gtest.h"


template<class T>
class Printer
{
public:
	T print(T value){return value;}
};

class Values :public::testing::TestWithParam<int>
{

};
TEST_P(Values,test_name)
{
	Printer<int>* p = new Printer<int>;
	int value = GetParam();
	ASSERT_EQ(p->print(value),value);	
}
INSTANTIATE_TEST_CASE_P(NombreLocal,Values,::testing::Values(1,2,3));


