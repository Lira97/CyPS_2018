#include "gtest/gtest.h"
#include "impresora.h"

using ::testing::ValuesIn;
using ::testing::Combine;
using ::testing::Range;



class Fix: public ::testing::TestWithParam<int>
{};

class Chars : public ::testing::TestWithParam<char>
{};

class Bools : public ::testing::TestWithParam<bool>
{};

class Comb : public ::testing::TestWithParam< ::testing::tuple<int,int> >
{
	public:
		int num1=::testing::get<0>(GetParam());
		int num2=::testing::get<1>(GetParam());
};

TEST_P(Fix,test1)
{
	print_value(GetParam());
}
/*TEST_P(bools,test2)
{
	print_value(GetParam());
}*/
TEST_P(Chars,test3)
{
	print_value(GetParam());
}
TEST_P(Comb,test4)
{
	print_tuple(num1,num2);
}

INSTANTIATE_TEST_CASE_P(local1,Fix,::testing::Values(1,2,3,4,5,6,7));
char arr[]= {'a','b','c'};
INSTANTIATE_TEST_CASE_P(local2,Chars,ValuesIn(arr));
INSTANTIATE_TEST_CASE_P(local3,Comb,Combine(Range(1,10,1),Range(1,10,1)));
//INSTANTIATE_TEST_CASE_P(local3,Bools,::testing::Value(true));

