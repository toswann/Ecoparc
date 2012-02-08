// This file is part of Ecoparc project.
//
// Ecoparc project is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Ecoparc project is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Ecoparc project.  If not, see <http://www.gnu.org/licenses/>.
//

#include "sysinfo.h"

sysinfo::sysinfo()
{
}

QString sysinfo::getMacAddress()
{
    QStringList items;

    foreach(QNetworkInterface interface, QNetworkInterface::allInterfaces())
    {
        if ( interface.isValid() && interface.flags().testFlag(QNetworkInterface::IsUp) && !interface.flags().testFlag(QNetworkInterface::IsLoopBack))
            foreach (QNetworkAddressEntry entry, interface.addressEntries())
            {
            if ( interface.hardwareAddress() != "00:00:00:00:00:00" && entry.ip().toString().contains(".")) {
             //qDebug() <<   "get mac " << interface.hardwareAddress();
                return interface.hardwareAddress();
            }
        }
    }
    return NULL;
}

QString sysinfo::getIpAddress()
{
    QStringList items;

    foreach(QNetworkInterface interface, QNetworkInterface::allInterfaces())
    {
        if ( interface.isValid() && interface.flags().testFlag(QNetworkInterface::IsUp) && !interface.flags().testFlag(QNetworkInterface::IsLoopBack))
            foreach (QNetworkAddressEntry entry, interface.addressEntries())
            {
            if ( interface.hardwareAddress() != "00:00:00:00:00:00" && entry.ip().toString().contains(".")) {
            //    qDebug() <<   "get ip " << entry.ip().toString();
                return entry.ip().toString();
            }
        }
    }
    return NULL;
}
