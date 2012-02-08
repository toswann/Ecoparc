#include "cpuwindows.h"

#include <Windows.h>
#include <iostream>
#include <iomanip>
#include <stdio.h>
#include <time.h>

using namespace std;

ULONGLONG subtractTime(const FILETIME &a, const FILETIME &b)
{
    LARGE_INTEGER la, lb;
    la.LowPart = a.dwLowDateTime;
    la.HighPart = a.dwHighDateTime;
    lb.LowPart = b.dwLowDateTime;
    lb.HighPart = b.dwHighDateTime;

    return la.QuadPart - lb.QuadPart;
}

cpuwindows::cpuwindows()
{
    this->usage = NULL;
}


float cpuwindows::getUsage(FILETIME *prevSysKernel, FILETIME *prevSysUser,
               FILETIME *prevProcKernel, FILETIME *prevProcUser,
               bool firstRun = false)
{
    FILETIME sysIdle, sysKernel, sysUser;
    FILETIME procCreation, procExit, procKernel, procUser;

    if (!GetSystemTimes(&sysIdle, &sysKernel, &sysUser) ||
        !GetProcessTimes(GetCurrentProcess(), &procCreation, &procExit, &procKernel, &procUser))
    {
        // can't get time info so return
        return -1.;
    }

    // check for first call
    if (firstRun)
    {
        // save time info before return
        prevSysKernel->dwLowDateTime = sysKernel.dwLowDateTime;
        prevSysKernel->dwHighDateTime = sysKernel.dwHighDateTime;

        prevSysUser->dwLowDateTime = sysUser.dwLowDateTime;
        prevSysUser->dwHighDateTime = sysUser.dwHighDateTime;

        prevProcKernel->dwLowDateTime = procKernel.dwLowDateTime;
        prevProcKernel->dwHighDateTime = procKernel.dwHighDateTime;

        prevProcUser->dwLowDateTime = procUser.dwLowDateTime;
        prevProcUser->dwHighDateTime = procUser.dwHighDateTime;

        return -1.;
    }

    ULONGLONG sysKernelDiff = subtractTime(sysKernel, *prevSysKernel);
    ULONGLONG sysUserDiff = subtractTime(sysUser, *prevSysUser);

    ULONGLONG procKernelDiff = subtractTime(procKernel, *prevProcKernel);
    ULONGLONG procUserDiff = subtractTime(procUser, *prevProcUser);

    ULONGLONG sysTotal = sysKernelDiff + sysUserDiff;
    ULONGLONG procTotal = procKernelDiff + procUserDiff;

    return (float)((100.0 * procTotal)/sysTotal);
}


float cpuwindows::getCPUInfo() {
    FILETIME prevSysKernel, prevSysUser;
    FILETIME prevProcKernel, prevProcUser;

    if (this->usage == NULL)
        this->usage = getUsage(&prevSysKernel, &prevSysUser, &prevProcKernel, &prevProcUser, true);

    this->usage = getUsage(&prevSysKernel, &prevSysUser, &prevProcKernel, &prevProcUser);
    return (this->usage);
}
