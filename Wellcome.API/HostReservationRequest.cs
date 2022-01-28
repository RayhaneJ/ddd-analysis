using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Wellcome.API
{
    public class HostReservationRequest
    {
        public string Email { get; set; }
        public string HostUuid { get; set; }
        public string Phone { get; set; }
        public string Message { get; set; }
    }
}
