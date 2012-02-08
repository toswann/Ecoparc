#ifndef CPUWINDOWS_H
#define CPUWINDOWS_H

#include <iostream>
#include <iomanip>
#include <stdlib.h>
#include <Windows.h>

class cpuwindows
{
    float usage;
public:
    cpuwindows();
    float getCPUInfo();

private:
    float getUsage(FILETIME *prevSysKernel, FILETIME *prevSysUser,
                   FILETIME *prevProcKernel, FILETIME *prevProcUser,
                   bool firstRun);
};

#endif // CPUWINDOWS_H
