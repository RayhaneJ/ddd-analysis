using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Wellcome.DataModel
{
    public class FavoriteHost
    {
        public int UserId { get; set; }
        public User User { get; set; }

        public int HostId { get; set; }
        public Host Host { get; set; }
    }
}
